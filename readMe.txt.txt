# Mein BlogPost Projekt

### Technologien:
- React
- PHP (vanilla)


### Herausforderungen:
1. **Problem**: Kommunikation zwischen PHP und react (first touch)
   - **Lösung**: PHP File wird über fetch angesteuert und mit Zusätzlichem Options Obj versehen.
   - **Lösung**: PHP File ganz normal DB Connection, User Query, Password verify, danach wichtig: echo json_encode (neu)
   - **Lösung**: Files in separaten Folders, htdocs und React App.

2. **Problem**: Für dieses Projekt wurde kein dotenv File verwendet!
   - **Lösung**: fürs nächste Mal

### Fehlerbehebungen:
- Beim Testen der API hatte ich CORS Probleme zum lösen.
- Einige Typos im Query/ $data / ->execute
- Hauptschwirigkeit: transfer von XAMP DB zu infinityFree DB. ($_SESSION variable not persistent: credentials: 'include')

