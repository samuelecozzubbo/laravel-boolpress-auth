# Avvia il Pannello di Controllo di XAMPP
Start-Process "C:\ProgramData\Microsoft\Windows\Start Menu\Programs\XAMPP\XAMPP Control Panel.lnk"

# Apri i terminali in background senza metterli in primo piano
# Terminale per 'php artisan serve'
Start-Process powershell -ArgumentList '-NoExit', '-Command', 'cd C:\Users\Samuele\Desktop\CorsoBoolean\LARAVEL\PROGETTI\laravel-boolstrap-auth; php artisan serve'

# Terminale per 'npm run dev'
Start-Process powershell -ArgumentList '-NoExit', '-Command', 'cd C:\Users\Samuele\Desktop\CorsoBoolean\LARAVEL\PROGETTI\laravel-boolstrap-auth; npm run dev'
