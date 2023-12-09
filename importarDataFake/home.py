import subprocess

def execute_php_function(php_executable, php_script_path, function_name, *args):
    command = [php_executable, php_script_path, function_name] + list(args)
    result = subprocess.run(command, capture_output=True, text=True)
    return result.stdout.strip()

cantidad_anios = "1"
cant_registros_dia = "1"
fecha_inicio = '2023-01-01 00:00:00'
php_executable = r'C:\xampp\php\php.exe'  
php_script_path = r'C:\xampp\htdocs\iatest\script.php'
function_name = 'loadData'
result = execute_php_function(php_executable, php_script_path, function_name, cantidad_anios, cant_registros_dia)
print("Cargando...")
if result == "si":
    print("¡Data cargada!")
else:
    print("data no se cargo")