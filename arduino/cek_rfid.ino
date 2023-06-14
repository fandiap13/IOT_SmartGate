#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <ArduinoJson.h>
#include <Servo.h>
#include <LiquidCrystal_I2C.h>
//#include <Wire.h>

#define RST_PIN D0 // D1
#define SDA_PIN D4 // D2
#define SERVO_PIN D3
#define BUZZER_PIN 9
#define ECHO_PIN D8
#define TRIG_PIN 10
//#define SCL_pin D1 //Pin D5
//#define SDA_pin D2 //Pin D6

MFRC522 mfrc522(SDA_PIN, RST_PIN);
HTTPClient http;
WiFiClient wifiClient;
Servo servo;
LiquidCrystal_I2C lcd(0x27, 20, 4);
StaticJsonDocument<1024> doc;

int statusGerbang = 0;
float jarak;
int pos;

void setup() {
  Serial.begin(9600);

  lcd.init();
  lcd.backlight();
  lcd.clear();
  lcd.setCursor (0,0); //
  
//  pinMode(9, OUTPUT);
  servo.attach(SERVO_PIN);
  servo.write(0);

  WiFi.begin("ISI SENDIRI", "ISI SENDIRI");
  lcd.print("WIFI Disconnect !"); 
  while (WiFi.status() != WL_CONNECTED) {
    delay(100);
    Serial.println("WIFI Disconnect !");  
  }
  Serial.println("WIFI Connect !");
  lcd.clear();
  lcd.print("WIFI Connect !");  
  
  SPI.begin();
  mfrc522.PCD_Init();
  Serial.println("Scan kartu...");
  lcd.clear();
  lcd.print("Scan kartu..."); 

  pinMode(TRIG_PIN, OUTPUT);
  pinMode(ECHO_PIN, INPUT);  
}

void bukaGerbang() {
//  digitalWrite(BUZZER_PIN, HIGH);
//  delay(500);
//  digitalWrite(BUZZER_PIN, LOW);
  for (pos = 0; pos <= 180; pos += 1) {
    servo.write(pos);
    delay(5);
  }
  statusGerbang = 1;
  Serial.println("Buka gerbang");
}

void tutupGerbang() {
  delay(5000);
  for (pos = 180; pos > 0; pos -= 1) {
    servo.write(pos);
    delay(5);
  }
  statusGerbang = 0;
  Serial.println("Tutup gerbang");
  lcd.clear();
  lcd.print("Scan kartu...");
}

void loop() {
  digitalWrite(TRIG_PIN, LOW);
  delayMicroseconds(2);
  digitalWrite(TRIG_PIN, HIGH);
  delayMicroseconds(10);
  digitalWrite(TRIG_PIN, LOW);
  int duration = pulseIn(ECHO_PIN, HIGH);
  jarak = duration * 0.034 / 2;
//Serial.println(jarak);

//  jika jarak lebih dari 2 atau sama dengan 10 cm
  if (statusGerbang == 1 && jarak >= 10) {
    tutupGerbang();
  }
  
  if(!mfrc522.PICC_IsNewCardPresent()){
    return;
  }

  if(!mfrc522.PICC_ReadCardSerial()){
    return;
  }

  Serial.print("UID tag :");
  String content = "";
  byte letter;

  for(byte i = 0; i < mfrc522.uid.size; i++){
    Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
    Serial.print(mfrc522.uid.uidByte[i], HEX);
    content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
    content.concat(String(mfrc522.uid.uidByte[i], HEX));
  }

  content.toUpperCase();

  String kode = content.substring(1);

  Serial.println("ID ku: " + (String) content.substring(1));
  http.begin(wifiClient, "http://keamanan-kost.000webhostapp.com/api.php");
  String Post = "rfid_code=" + (String) kode;
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  int httpResponseCode = http.POST(Post);
  String payload = http.getString();
  Serial.println("Payload: " + payload);
  Serial.println(httpResponseCode);
  http.end();

  deserializeJson(doc, payload);
  if (httpResponseCode == 200) {
      lcd.clear();
      lcd.print(doc["message"].as<String>());
      bukaGerbang();
  } else {
      lcd.clear();
      lcd.print(doc["error"].as<String>());
      delay(3000);
      lcd.clear();
      lcd.print("Scan kartu...");
  }
}
