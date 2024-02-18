#include <Adafruit_MLX90614.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_SSD1306.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

//set wifi
const char* ssid = "GlobeAtHome_29E53"; //for //"Test_wifi";  
const char* password = "57A433E3"; // for //"12345678";  
const char *host = "http://192.168.254.198/project";
 //"http://192.168.43.237/";
 // 192.168.254.198 ip of globe at home
 
WiFiClient client;
HTTPClient httpClient;

// Creating an instance of an object
Adafruit_MLX90614 mlx = Adafruit_MLX90614();
LiquidCrystal_I2C lcd(0x27, 16, 2);

MFRC522 mfrc522(2, 0); //MFRC522 instance. //sda, rst
//int pinRelay=5;
int status = WL_IDLE_STATUS;
char response[40];
int res;
int param, flag; // variables for while condition 
int rr;
int isrf_id, isreset, limit, isRequest; // isRequest is for fetching rf id for student form
float temp;
long uid;

#define LED_PIN D8 
#define BUZZ_PIN D8
//#define SUCCESS_PIN D0
//#define ERROR_PIN D0 
//#define pinRelay D0

void setup() {
  Serial.begin(9600);
  //display
  Wire.begin();
  Serial.println("Welcome to STeMS");
  pinMode(BUZZ_PIN, OUTPUT);
  lcd.init();   
  lcd.backlight(); // Enable or Turn On the backlight 
  mlx.begin(); 
  SPI.begin();
  mfrc522.PCD_Init(); 
  getWiFi();
//  Serial.println("initiate protocol"); //start
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("STeMS");
  lcd.setCursor(0,1);
  lcd.print("IOT project");
  delay(3000);
}

void loop() {
   // landing 
  lcd.clear();   
  buzzStart();
  Serial.print("Welcome User");
  delay(2000);

  isrf_id = 0; // set to false     
  res = 0;
 if (res==0){ // please review the code here
    lcd.setCursor(2,0);
    lcd.println("Checking");
    lcd.setCursor(1,1);
    lcd.println("getDataID()");
    getDataId();
      if(isRequest == 1){
        flag = 0;
        while(flag != 1 ){
          if (mfrc522.PICC_IsNewCardPresent()) {
            if (mfrc522.PICC_ReadCardSerial()) {
              buzzRfScan();    
              long code=0;
              for (byte i = 0; i < mfrc522.uid.size; i++){
                code=((code+mfrc522.uid.uidByte[i])*10);
              }
              lcd.clear();
              lcd.setCursor(5, 0);
              lcd.println("RFID");
              lcd.setCursor(3, 1);
              lcd.print(code);
              postNewRf(code);
              mfrc522.PICC_HaltA();
              mfrc522.PCD_StopCrypto1();
              lcd.clear();
              lcd.setCursor(5, 0);
              lcd.println("RFID");
              lcd.setCursor(3, 1);
              lcd.print("registered");
              flag = 1;
              res = 1;
              return;
            }
          }
        }
      }
      if(isRequest == 0){
        Serial.print("request not found");
        res = 1;
      }
      // else{
      //   res = 0;
      //   return;
      // }
      res = 1;
 }
// phase 1
if (res==1){ 
  lcd.setCursor(2,0);
  lcd.println("Scan RFID");
  param = 0; 
  while (param == 0){
    if (mfrc522.PICC_IsNewCardPresent()) {
      if (mfrc522.PICC_ReadCardSerial()) {
        buzzRfScan();    
        long code=0;
        for (byte i = 0; i < mfrc522.uid.size; i++){
          code=((code+mfrc522.uid.uidByte[i])*10);
        }
          lcd.clear();
          lcd.setCursor(5, 0);
          lcd.println("RFID");
          lcd.setCursor(3, 1);
          lcd.print(code);    
          uid = code;
          Serial.println(code);
          checkRfidLog(code);
          delay(300);
          mfrc522.PICC_HaltA();
          mfrc522.PCD_StopCrypto1();
          getData();    
          delay(300);
          if(isreset == 1){        
            Serial.println("RFID is not register");
            lcd.clear();
            lcd.setCursor(0, 0);
            lcd.println("RFID");
            delay(1000);
            lcd.clear();
            lcd.setCursor(3, 0);
            lcd.println("is not");
            lcd.setCursor(0, 1);
            lcd.println("register");
            delay(1000);
            lcd.clear();
            digitalWrite(LED_PIN, LOW);
            res = 0;
            getData();
            return;
          }
          else{
            res=2;  
            param=1;
          }       

      }
    }
  }
  delay(300);
  res=2;
}
// phase 2
if (res==2){ // waiting for temperature measurement
  param = 0; 
  limit = 0;
  buzzTemp();
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.println("Scan Temperature");
  Serial.println("Scan Temperature");
    // Serial.println(uid);
  while (param == 0){
    mlx.readObjectTempC();
    temp = mlx.readObjectTempC() + 0.8;  
    // temp = 38;
    delay(300);
    if (temp>=35.0 && temp<= 37.4){
      buzzTemp();
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.println("Temperature:");
      lcd.setCursor(3,1);
      lcd.println(temp);
//         Serial.println(temp);
      sendTemp(temp,uid);
      delay(300);
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.println("Normal");
      lcd.setCursor(0,1);
      lcd.println("Temperature");
      delay(1000);
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.println("Successfully");
      lcd.setCursor(3,1);
      lcd.println("Added");          
      delay(500);
      param = 1;
      res=3;
    }        
    else if (temp>37.5){
      buzzWarning();
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.println("Temperature:");
      lcd.setCursor(3,1);
      lcd.println(temp);
      delay(1000);
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.println("Temperature");
      lcd.setCursor(3,1);
      lcd.println("Is HIGH");
//         Serial.println(temp);
      lcd.clear();
      lcd.setCursor(0,0);
      lcd.println("Scan");
      lcd.setCursor(3,1);
      lcd.println("Again");
      limit = 1 + limit;
      if(limit >= 3){
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.println("Error");
        lcd.clear();
        lcd.setCursor(0,0);
        lcd.println("Try again");
        lcd.setCursor(0,1);
        lcd.println("a minute");
        sendHighTemp(temp,uid);
        res = 0;
        Serial.println("Storing data into temperature log");
        return;
      }
      // Serial.println("test scanning temp");
      delay(500);
      res = 2;
    }
    // int set = res;
  }
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.println("Pls wait...");      
  delay(1000);
}
// phase 3
if (res==3){ // Show data in the attendance sheet
  showData(uid);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.println("Data" );
  lcd.setCursor(0, 1);
  lcd.println("Uploaded");
  Serial.println("Data Uploaded");      
  delay(1000);
  buzzStart();
}
// lcd.clear();
}

void getWiFi(){
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
     delay(3000);
     Serial.print(".");
  }
  //print a new line, then print WiFi connected and the IP address
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println(WiFi.localIP());
  }

void postNewRf(long cardid){
 if(WiFi.status() == WL_CONNECTED) {
   HTTPClient http; //--> Declare object of class HTTPClient
   String GetAddress, LinkGet, getData;
//   int cardid =  0; //--> ID in Database
   GetAddress = "/backend/process_copy.php?"; 
   LinkGet = host + GetAddress;
   getData = "cardid=" + String(cardid) + "&action=addCardId"; // create a function in process.php
   http.begin(client, LinkGet); //--> Specify request destination
   http.addHeader("Content-Type", "application/x-www-form-urlencoded");
   int httpCodeGet = http.POST(getData); //--> Send the request
   String payloadGet = http.getString(); //--> Get the response payload from server
   Serial.print("Response Code : "); 
   Serial.println(httpCodeGet); 
   Serial.print("Returned data from Server : ");
   Serial.println(payloadGet);

  //  if (payloadGet == "1") {
  //    digitalWrite(LED_PIN, HIGH);
  //    Serial.print("scan new rf id");
  //    isRequest = 1; //TRUE
  //    // res = 0;
  //    digitalWrite(LED_PIN, LOW);
  //  }
  //  if (payloadGet == "0") {
  //    digitalWrite(LED_PIN, LOW);
  //    Serial.print("scan for temperature");
  //    isRequest = 0;
  //  }
   http.end(); //--> Close connection
   delay(500);
   }
}
 // the posting data need to be fix tom
void checkRfidLog(long cardid){
 if(WiFi.status() == WL_CONNECTED) {
//    Serial.println("this is to check if it is connected");
    HTTPClient http;
    String link = "http://192.168.254.198/project/backend/process_copy.php?";
    String postData = "cardid=" + String(cardid) + "&action=checkRecord"; 
    http.begin(client, link);            
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  
    
    int httpCode = http.POST(postData); 
    String payload = http.getString();
    Serial.println(httpCode);
    Serial.println(payload);
    
    http.end();
    }  
}
void sendTemp(float Temperature, long cardid) {
//  Serial.println("temp check");
  if(WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String link = "http://192.168.254.198/project/backend/process_copy.php?";
    String postData = "Temperature=" + String(Temperature) + "&cardid=" + String(cardid) + "&action=getTemp";
    http.begin(client, link);            
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  
    
    int httpCode = http.POST(postData); 
    String payload = http.getString();
    Serial.println(httpCode);
    Serial.println(payload);
    
    http.end();
  }
}

void sendHighTemp(float Temperature, long cardid){
  if(WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    String link = "http://192.168.254.198/project/backend/process_copy.php?";
    String postData = "Temperature=" + String(Temperature) + "&cardid=" + String(cardid) + "&action=storeHighTemp";
    http.begin(client, link);            
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");  
    
    int httpCode = http.POST(postData); 
    String payload = http.getString();
    Serial.println(httpCode);
    Serial.println(payload);

    res = 0;
    http.end();
  }
}
int getDataId(){
  if(WiFi.status() == WL_CONNECTED) {
  HTTPClient http; //object of class HTTPClient

  String GetAddress, LinkGet, getDataId;
  int id = 0; //--> ID in Database
  GetAddress = "/backend/process_copy.php?"; 
  LinkGet = host + GetAddress; //--> request destination
  getDataId = "id=" + String(id) + "&action=getDataId";

  http.begin(client, LinkGet); //request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //content-type header
  int httpCode = http.POST(getDataId); //--> Send the request
  String payload = http.getString(); //--> Get the response payload from server
  Serial.print("Response Code : ");
  Serial.println(httpCode); 
  Serial.print("Returned data from Server : ");
  Serial.println(payload); 

  if (payload == "1") {
    digitalWrite(LED_PIN, HIGH);
    Serial.print("Ready to scan new rf_id");
    isRequest = 1; // True
    res = 0;
    Serial.println(isreset);
    digitalWrite(LED_PIN, LOW);
  }
  if (payload == "0") {
    digitalWrite(LED_PIN, LOW);
    Serial.print("No request found");
    isRequest = 0; // False
  }
  Serial.println(isRequest);
  http.end(); //--> Close connection
  delay(500);
  return isRequest;
  }
}

int getData(){
  if(WiFi.status() == WL_CONNECTED) {
  HTTPClient http; //object of class HTTPClient

  String GetAddress, LinkGet, getData;
  int id = 0; //--> ID in Database
  GetAddress = "/backend/process_copy.php?"; 
  LinkGet = host + GetAddress; //--> request destination
  getData = "id=" + String(id) + "&action=getData";

  http.begin(client, LinkGet); //request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //content-type header
  int httpCodeGet = http.POST(getData); //--> Send the request
  String payloadGet = http.getString(); //--> Get the response payload from server
  Serial.print("Response Code : ");
  Serial.println(httpCodeGet); 
  Serial.print("Returned data from Server : ");
  Serial.println(payloadGet); 

  if (payloadGet == "1") {
    digitalWrite(LED_PIN, HIGH); //--> Turn off Led
    Serial.print("Retry");
    isreset = 1;
    res = 0;
    Serial.println(isreset);
    digitalWrite(LED_PIN, LOW);
  }
  if (payloadGet == "0") {
    digitalWrite(LED_PIN, LOW); //--> Turn off Led
    Serial.print("Continue");
    isreset = 0;
//    Serial.print(isreset);
  }
  Serial.println("----------------Closing Connection----------------");
  http.end(); //--> Close connection
  delay(500);
  return res;
  }
}

void showData(long cardid){
  if(WiFi.status() == WL_CONNECTED) {
  HTTPClient http; //--> Declare object of class HTTPClient
  String link = "http://192.168.254.198/project/backend/process_copy.php?";
  String showData =  "cardid=" + String(cardid) + "&action=showProcess";
  http.begin(client, link);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); 
  int httpCodeGet = http.POST(showData); //--> Send the request
  String payloadGet = http.getString(); //--> Get the response payload from server
  Serial.print("Response Code : "); //--> If Response Code = 200 means Successful connection, if -1 means connection failed.
  Serial.println(httpCodeGet); //--> Print HTTP return code
  Serial.print("Returned data from Server : ");
  Serial.println(payloadGet); //--> Print request response payload

// led confirmation for a success process
  if (httpCodeGet == 200) {
    digitalWrite(LED_PIN, HIGH); //--> Turn on Led equal to success
    delay(1000);
    digitalWrite(LED_PIN, LOW);
    digitalWrite(BUZZ_PIN, HIGH);
    delay(500);
    digitalWrite(BUZZ_PIN, LOW);
    delay(500);
    return;
  }
  if (httpCodeGet == -1) {
    digitalWrite(LED_PIN, LOW); //--> Turn on Led equal showDta fail
    digitalWrite(BUZZ_PIN, HIGH);
    delay(2000);
    digitalWrite(BUZZ_PIN, LOW);
    delay(2000);
  }
  http.end();
  }
}

void buzzStart(){
  digitalWrite(BUZZ_PIN, HIGH);
  delay(300);
  digitalWrite(BUZZ_PIN, LOW);
  delay(300);
}
void buzzRfScan(){
  digitalWrite(BUZZ_PIN, HIGH);
  delay(100);
  digitalWrite(BUZZ_PIN, LOW);
  delay(100);
  digitalWrite(BUZZ_PIN, HIGH);
  delay(100);
  digitalWrite(BUZZ_PIN, LOW);
  delay(100);
}
void buzzWarning(){
  for (int i=0; i>=2; i++){
    digitalWrite(BUZZ_PIN, HIGH);
    delay(1000);
    digitalWrite(BUZZ_PIN, LOW);
    delay(1000);
  }
}

void buzzTemp(){
    digitalWrite(BUZZ_PIN, HIGH);
    delay(100);
    digitalWrite(BUZZ_PIN, LOW);
    delay(100);
    digitalWrite(BUZZ_PIN, HIGH);
    delay(100);
    digitalWrite(BUZZ_PIN, LOW);
    delay(100);
}
