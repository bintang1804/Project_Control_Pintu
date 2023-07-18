#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>

const char* ssid = "jawir";
const char* password = "12345678";

const char* apiEndpoint = "http://50.19.247.56:8000/api/control";
const int relayPin = D0;

void setup() {
  Serial.begin(9600);

  pinMode(relayPin, OUTPUT);
  digitalWrite(relayPin, HIGH);  // Set relay awalnya dalam keadaan tertutup

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }

  Serial.println("Connected to WiFi");
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;

    if (http.begin(client, apiEndpoint)) {
      int httpResponseCode = http.GET();

      if (httpResponseCode == 200) {
        String payload = http.getString();
        
        DynamicJsonDocument jsonDocument(1024);
        DeserializationError error = deserializeJson(jsonDocument, payload);

        if (error) {
          Serial.print("JSON deserialization failed: ");
          Serial.println(error.c_str());
        } else {
          const char* openCloseStatus = jsonDocument["controls"][0]["open_close"];

          if (strcmp(openCloseStatus, "on") == 0) {
            Serial.println("Pintu terbuka");
            digitalWrite(relayPin, LOW);  // Buka relay
          } else if (strcmp(openCloseStatus, "off") == 0) {
            Serial.println("Pintu tertutup");
            digitalWrite(relayPin, HIGH);  // Tutup relay
          } else {
            Serial.println("Status pintu tidak valid");
          }
        }
      } else {
        Serial.print("HTTP request failed with error code: ");
        Serial.println(httpResponseCode);
      }

      http.end();
    } else {
      Serial.println("HTTP connection failed");
    }
  }

  delay(5000); // Interval pengambilan data dari API (dalam milidetik)
}
