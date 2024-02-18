#include <Adafruit_MLX90614.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Adafruit_SSD1306.h>
#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

//set wifi
const char* ssid = "GlobeAtHome_29E53";
const char* password = "57A433E3";
const char *host = "http://192.168.254.198";
const int sensorPin = A0;  //proximity sensor
 
WiFiClient client;
HTTPClient httpClient;

Adafruit_MLX90614 mlx = Adafruit_MLX90614();
LiquidCrystal_I2C lcd(0x27, 16, 2);

MFRC522 mfrc522(2, 0); //sda, rst
int status = WL_IDLE_STATUS;
//char response[40];
int res;
int param, flag; // variables for while condition 
//int rr;
int sensorValue;
int isrf_id, isreset, limit, isRequest, isFetch;

float temp;
long uid;
#define BUZZ_PIN D8
#define WARNING D0
#define GREEN 1

void setup() {
  Serial.begin(9600);
  Wire.begin();
  Serial.println("Welcome to STeMS");
  pinMode(BUZZ_PIN, OUTPUT);
  pinMode(WARNING, OUTPUT);
  pinMode(GREEN, OUTPUT);
  lcd.init();   
  lcd.backlight(); // Enable or Turn On the backlight 
  mlx.begin(); 
  SPI.begin();
  mfrc522.PCD_Init(); 
  getWiFi();
  lcd.clear();
  lcd.setCursor(3, 0);
  lcd.print("STeMS");
  lcd.setCursor(0,1);
  lcd.print("IOT Project");
  delay(2000);
  lcd.clear();   
  buzzStart();
  lcd.setCursor(3, 0);
  lcd.print("Welcome");
  delay(1000);
}

void loop() {
  isrf_id = 0;  
  res = 0;
 if (res==0){ 
      getDataId();
      if(isRequest == 1){
        Serial.print("Ready to scan new rf_id");
        lcd.clear();
        lcd.setCursor(2,0);
        lcd.println("Scan RF");
        lcd.setCursor(2,1);
        lcd.println("to register");
        delay(1000);
         flag = 0;
            while(flag != 1 ){
              getDataId();
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
                  delay(1000);
                  flag = 1;
                  
                }
              }
            }
            lcd.clear();
      }
      else if(isRequest == 2){        
        lcd.setCursor(2, 0);
        lcd.println("Processing");
        lcd.setCursor(4, 1);
        lcd.println("Data");
        getDataId();
        delay(5000);
        res = 0;
      }
      else if(isRequest == 0){
        delay(500);
        res = 1;

      }
  lcd.clear();
 }
// phase 1
if (res==1){ 
  lcd.setCursor(2,0);
  lcd.println("Scan RFID");
  param = 0; 
  while (param == 0){
    getDataId();
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
            // digitalWrite(LED_PIN, LOW);
            res = 0;
            getData();
            
          }
          else{
            res=2;  
            param=1;
          }       

      }
    }
  }
  
}
// phase 2
if (res==2){ 
  param = 0; 
  limit = 0;
  buzzTemp();
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.println("Scan Temperature");
  Serial.println("Scan Temperature");
  while (param == 0){
  sensorValue = analogRead(sensorPin); //
  if(sensorValue < 500){
    mlx.readObjectTempC();
    temp = mlx.readObjectTempC() + 2.8;
     if (temp>=35.0 && temp<= 37.4){
      buzzTemp();
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.println("Temperature:");
      lcd.setCursor(3,1);
      lcd.println(temp);
      sendTemp(temp,uid); // call the function
      delay(1000);
      if( isFetch == 1 ){
        delay(1000);
        buzzGreen();
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
        // Serial.print("gateway 1");
        delay(1000);
        param = 1;
        res=3;
      }
      else if( isFetch == 0 ){
       lcd.clear();
       lcd.setCursor(0,0);
       lcd.println("Fail to");
       lcd.setCursor(0,1);
       lcd.println("Update");
       delay(1000);
       param = 1;
       res = 0;
     }
     else if( isFetch != 0 || isFetch != 1){
       lcd.clear();
       lcd.setCursor(0,0);
       lcd.println("RF ID ");
       lcd.setCursor(0,1);
       lcd.println("Not Found");
       delay(1000);
       param = 1;
       res = 0;
     }
  }  
  else if (temp>37.5){
     lcd.clear();
     lcd.setCursor(0, 0);
     lcd.println("Temperature:");
     lcd.setCursor(3,1);
     lcd.println(temp);
     buzzWarning();
     lcd.clear();
     lcd.setCursor(0,0);
     lcd.println("Temperature");
     lcd.setCursor(3,1);
     lcd.println("Is HIGH");
     lcd.clear();
     lcd.setCursor(0,0);
     lcd.println("Scan");
     lcd.setCursor(3,1);
     lcd.println("Again");
     delay(2000);
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
       param = 1;
       res = 0;
       Serial.println("Storing data into temperature log");
       warningBeep();
     }
      res = res;
    }
    int set = res;
  }
    
    delay(300);
   }        
     
  
}
if (res==3){ // Show data in the attendance sheet
  showData(uid);
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.println("Data" );
  lcd.setCursor(0, 1);
  lcd.println("Uploaded");
  Serial.println("Data Uploaded");      
  digitalWrite(GREEN, HIGH);
  digitalWrite(BUZZ_PIN, HIGH);
  delay(500);
  digitalWrite(BUZZ_PIN, LOW);
  digitalWrite(GREEN, LOW);
  delay(1000);
}
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
   GetAddress = "/project/backend/process_copy.php?"; 
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

   http.end();
   delay(500);
   }
}
 // the posting data need to be fix tom
void checkRfidLog(long cardid){
 if(WiFi.status() == WL_CONNECTED) {
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
int sendTemp(float Temperature, long cardid) {
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

    if(payload == "updated temp record"){
      Serial.print("cool");
      isFetch = 1;
    }
    else if(payload == "failed to update"){
      isFetch = 0;
    }
    else{
      isFetch = 2;
    }
    http.end();
    return isFetch;
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
  GetAddress = "/project/backend/process_copy.php?"; 
  LinkGet = host + GetAddress; //--> request destination
  getDataId = "id=" + String(id) + "&action=getDataId";

  http.begin(client, LinkGet); //request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded"); //content-type header
  int httpCode = http.POST(getDataId); //--> Send the request
  String payload = http.getString(); //--> Get the response payload from server
  // Serial.print("Response Code : ");
  Serial.print(httpCode);
  Serial.print(" ");
  // Serial.print("Returned data from Server : ");
  Serial.println(payload); 

  if (payload == "1") {
    delay(1000);
    res = 0;
    flag = 1;
    param = 1;
    isRequest = 1;
  }
  else if(payload == "2" ){
    delay(5000);
    isRequest = 2;
//    return;
  }
  else if (payload == "0") {
    delay(500);
    flag = 1;
    param = 1;
    isRequest = 0;
    res = 1 ; // False
  }
  // Serial.println(isRequest);
  http.end();
   return isRequest;
  }
}

int getData(){
  if(WiFi.status() == WL_CONNECTED) {
  HTTPClient http; //object of class HTTPClient

  String GetAddress, LinkGet, getData;
  int id = 0; //--> ID in Database
  GetAddress = "/project/backend/process_copy.php?"; 
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
    digitalWrite(WARNING, HIGH); //--> Turn off Led
    delay(1000);
    // Serial.print("Retry");
    isreset = 1;
    res = 0;
    Serial.println(isreset);
    digitalWrite(WARNING, LOW);
  }
  if (payloadGet == "0") {
    // Serial.print("Continue");
    isreset = 0;
  }
  Serial.println("----------------Closing Connection----------------");
  http.end();
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
  Serial.print("Response Code : ");
  Serial.println(httpCodeGet); //--> Print HTTP return code
  Serial.print("Returned data from Server : ");
  Serial.println(payloadGet); //--> Print request response payload

// led confirmation for a success process
  // if (payloadGet == "success") {
  //   digitalWrite(BUZZ_PIN, HIGH);
  //   digitalWrite(GREEN, HIGH);
  //   delay(500);
  //   digitalWrite(BUZZ_PIN, LOW);
  //   delay(500);
  //   digitalWrite(BUZZ_PIN, HIGH);
  //   delay(500);
  //   digitalWrite(BUZZ_PIN, LOW);
  //   digitalWrite(GREEN, LOW);
  //   delay(500);
  // }
  // else if (payloadGet != "success") {
  //   digitalWrite(WARNING, HIGH); //--> Turn on Led equal showData fail
  //   digitalWrite(BUZZ_PIN, HIGH);
  //   delay(2000);
  //   digitalWrite(BUZZ_PIN, LOW);
  //   digitalWrite(WARNING, LOW);
  //   delay(2000);
  // }
  http.end();
  }
}

void buzzStart(){
  digitalWrite(BUZZ_PIN, HIGH);
  digitalWrite(GREEN, HIGH);
  delay(300);
  digitalWrite(GREEN, LOW);
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
  // for (int i=0; i>=2; i++){
    digitalWrite(BUZZ_PIN, HIGH);
    digitalWrite(WARNING, HIGH );
    delay(2000);
    digitalWrite(BUZZ_PIN, LOW);
    digitalWrite(WARNING, LOW);
    delay(1000);
}
void buzzGreen(){
  digitalWrite(BUZZ_PIN, HIGH);
    digitalWrite(GREEN, HIGH );
    delay(300);
    digitalWrite(BUZZ_PIN, LOW);
    digitalWrite(GREEN, LOW);
    delay(300);
}

void warningBeep(){
    digitalWrite(BUZZ_PIN, HIGH);
    digitalWrite(WARNING, HIGH );
    delay(300);
    digitalWrite(BUZZ_PIN, LOW);
    delay(300);
    digitalWrite(BUZZ_PIN, HIGH);
    delay(300);
    digitalWrite(BUZZ_PIN, LOW);
    delay(300);
    digitalWrite(BUZZ_PIN, HIGH);
    delay(300);
    digitalWrite(BUZZ_PIN, LOW);
    digitalWrite(WARNING, LOW);
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
 