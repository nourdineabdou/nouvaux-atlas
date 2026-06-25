<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Serveur en maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(180deg, #0b1734 0%, #0d2143 100%);
            color: #f8f9fa;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .maintenance-card {
            max-width: 980px;
            width: 100%;
            padding: 2rem;
            border-radius: 1.5rem;
            background: rgba(255,255,255,0.08);
            box-shadow: 0 20px 80px rgba(0,0,0,0.35);
            backdrop-filter: blur(18px);
        }
        .maintenance-card img {
            max-width: 100%;
            border-radius: 1rem;
            object-fit: cover;
        }
        .maintenance-title {
            font-size: 2.75rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }
        .maintenance-text {
            color: #d1d5db;
        }
    </style>
</head>
<body>
    <div class="maintenance-card">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-danger mb-3">SERVEUR CHUT DOWN</span>
                <h1 class="maintenance-title">Nous sommes momentanément indisponibles</h1>
                <p class="maintenance-text">Le site est en maintenance périodique. Revenez dans quelques instants ou contactez l'administrateur si besoin.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1200&q=80" alt="Serveur en panne">
            </div>
        </div>
    </div>
</body>
</html>
