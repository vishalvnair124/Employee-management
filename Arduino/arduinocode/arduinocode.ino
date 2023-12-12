#include <Servo.h>

Servo myservo;
int pos = 0;    // variable to store the servo position
boolean doorstatus=false;
boolean outsider=false;
boolean insider=false;
int rfid, finalRfid = 0;

#include <Adafruit_Fingerprint.h>
SoftwareSerial mySerial(2, 3);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

void setup() {
  pinMode(6,INPUT);
  myservo.attach(9); 
  Serial.begin(9600);
  finger.begin(57600);
  delay(5);
  if (finger.verifyPassword()) {
  } else {
    while (1) { delay(1); }
  }

  finger.getParameters();
  finger.getTemplateCount();
}

void loop() { 

if(insider==false&&outsider==false){
  rfid = getFingerprintIDez();
  if (rfid >= 0) {
    if (doorstatus == false) {
      finalRfid = rfid;
      open();
      outsider=true;
      doorstatus = true;
      
    }
    
  }

  if(digitalRead(6) == LOW) {
    delay (100);
    while (digitalRead(6) == LOW);
    
    if(doorstatus==false) {
      open();
      doorstatus = true;
      insider=true;
    }
  }
}
if(outsider){
    
  if(digitalRead(6) == LOW) {
   
    delay (100);
    while (digitalRead(6) == LOW);
   
    if(doorstatus==true) {
      close();
      doorstatus = false;
      Serial.print ('*');
      Serial.print (finalRfid);
      Serial.println(",IN#");
      outsider=false;
    }
  }
}
if(insider){
   
  rfid = getFingerprintIDez();
  if (rfid >= 0) {
    if (doorstatus == true) {
      close();
      doorstatus = false;
      Serial.print ('*');
      Serial.print (rfid);
      Serial.println (",OUT#");
      insider=false;
    }
  }
}

}

void close() {
  for (pos = 0; pos <= 90; pos += 1) {
    myservo.write(pos);              // tell servo to go to position in variable 'pos'
    delay(15);                       // waits 15 ms for the servo to reach the position
  }

}

void open() {
  for (pos = 90; pos >= 0; pos -= 1) { // goes from 180 degrees to 0 degrees
    myservo.write(pos);              // tell servo to go to position in variable 'pos'
    delay(15);                       // waits 15 ms for the servo to reach the position
  }
}

int getFingerprintIDez() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return -1;

  // found a match!
  
  // Serial.print("Found ID #"); Serial.print(finger.fingerID);
  // Serial.print(" with confidence of "); Serial.println(finger.confidence);

  
  return finger.fingerID;
}

