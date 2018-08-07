#include <SPI.h>
#include <MFRC522.h>

#define RST_PIN  9    //Pin 9 para el reset del RC522
#define SS_PIN  10   //Pin 10 para el SS (SDA) del RC522
MFRC522 mfrc522(SS_PIN, RST_PIN); ///Creamos el objeto para el RC522

int motor = 7;     //Declaro pin que abre la puerta
int motor2 = 8;    //Declaro pin que cierra la puerta

void setup() {
  Serial.begin(9600); //Iniciamos La comunicacion serial
  SPI.begin();        //Iniciamos el Bus' SPI
  mfrc522.PCD_Init(); // Iniciamos el MFRC522
  //Serial.println("Control de acceso:");
  pinMode(motor, OUTPUT);
  pinMode(motor2, OUTPUT);
  digitalWrite(motor, HIGH);
  digitalWrite(motor2, HIGH);
}

void loop() {
  // Revisamos si hay nuevas tarjetas  presentes
  if ( mfrc522.PICC_IsNewCardPresent()) {  
    //Seleccionamos una tarjeta
    if ( mfrc522.PICC_ReadCardSerial()) { // Enviamos serialemente su UID
      //Serial.print(F("Card UID:"));
      for (byte i = 0; i < mfrc522.uid.size; i++) {
        Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : "");
        Serial.print(mfrc522.uid.uidByte[i], HEX);   
      }
      
      Serial.println();
      // Terminamos la lectura de la tarjeta actual
      mfrc522.PICC_HaltA();
    }
     
     if (Serial.available() >= 0) {
        char c = Serial.read();
        if (c == 'A') {
          AbrirPuerta();                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
          delay(30000);
          CerrarPuerta();
       }
     }
  }
}

void AbrirPuerta() {
  digitalWrite(motor, LOW);
  delay(100);
  digitalWrite(motor, HIGH);
}


void CerrarPuerta() {
  digitalWrite(motor2, LOW);
  delay(100);
  digitalWrite(motor2, HIGH);
}
