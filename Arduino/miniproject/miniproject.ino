#include <Adafruit_Fingerprint.h>
SoftwareSerial mySerial(2, 3);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

int rfid, finalRfid = 0;
int buttonInPin = 6; // Modify this pin as needed
int buttonOutPin = 7; // Modify this pin as needed
boolean button = false;

void setup() {
  pinMode(13, OUTPUT); 
  pinMode(buttonInPin, INPUT_PULLUP);
  pinMode(buttonOutPin, INPUT);
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
  if (!button) {
     digitalWrite(13, LOW);
    rfid = getFingerprintIDez();
    if (rfid >= 0) {
      finalRfid = rfid;
      button = true;
    }
  } else {
     digitalWrite(13, HIGH);
    if (digitalRead(buttonInPin) == LOW) {
      delay(100);
      while (digitalRead(buttonInPin) == LOW);
      Serial.print('*');
      Serial.print(finalRfid);
      Serial.println(",IN#");
      button = false;
    }
    if (digitalRead(buttonOutPin) == LOW) {
      delay(100);
      while (digitalRead(buttonOutPin) == LOW);
      Serial.print('*');
      Serial.print(finalRfid);
      Serial.println(",OUT#");
      button = false;
    }
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
