<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
</head>
<body>
    <h1>Employee Dashboard</h1>

    @if (session('employee'))
        <p>Hola, {{ session('firstName') }} {{ session('lastName') }}</p>
        <p>Employee ID: {{ session('employee')->employee_id }}</p>
        <!-- Puedes agregar más información aquí -->

        <!-- Botón para cerrar sesión -->
        <form action="{{ route('employee.logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    @else
        <p>No se encontró información del empleado en la sesión.</p>
    @endif
</body>
</html>
