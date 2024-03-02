#include "DHT.h"
#include "LiquidCrystal_I2C.h"
#include  "Wire.h"

#define DHTPIN 7  
#define DHTTYPE DHT11

const int LIGHT_SENSOR_PIN = A0;
const int LED_PIN = 13;
const int ANALOG_THRESHOLD = 300;

DHT dht(DHTPIN, DHTTYPE);
LiquidCrystal_I2C lcd(0x27,  16, 2);

int analogValue;

void setup(){
  Serial.begin(9600);
  dht.begin();
  pinMode(LED_PIN, OUTPUT);
  lcd.init();
  lcd.backlight();
}

void loop() {
  // Wait a few seconds between measurements.
  delay(2000);

  analogValue = analogRead(LIGHT_SENSOR_PIN);
  float humidity = dht.readHumidity();
  float temp = dht.readTemperature();
  float faren = dht.readTemperature(true);

  // Check if any reads failed and exit early (to try again).
  if (isnan(humidity) || isnan(temp) || isnan(faren)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }
  if(isnan(analogValue)) {
    Serial.println(F("Failed to read from Light sensor!"));
    return;
  }

  if(analogValue < ANALOG_THRESHOLD)
    digitalWrite(LED_PIN, HIGH); // turn on LED
  else
    digitalWrite(LED_PIN, LOW);  // turn off LED

  Serial.print(F("<"));
  Serial.print(humidity);
  Serial.print(",");
  Serial.print(temp);
  Serial.print(",");
  Serial.print(faren);
  Serial.print(",");
  Serial.print(analogValue);
  Serial.println(F(">"));

  lcd.setCursor(0,0);
  lcd.print(temp);
  lcd.print("C, ");
  lcd.print(faren);
  lcd.print("F");
  lcd.setCursor(0,1);
  lcd.print(humidity);
  lcd.print("%, ");
  lcd.print(analogValue);
  lcd.print(" Lm");
}
