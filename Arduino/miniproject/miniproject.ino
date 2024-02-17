#include <Adafruit_Fingerprint.h>

#include <Adafruit_Fingerprint.h>
SoftwareSerial mySerial(2, 3);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

int rfid=-1;


void setup() {
  pinMode(13, OUTPUT); 
  
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
  rfid = getFingerprintIDez();
  if(rfid>-1){
  Serial.print("*");
  Serial.print(rfid);
  Serial.print("#");
  rfid=-1;
  delay(250);
  }
}

int getFingerprintIDez() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)  return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return -1;

  return finger.fingerID;
}