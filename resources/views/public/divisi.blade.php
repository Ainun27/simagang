<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title>Program Magang - Diskominfosantik Kota Bekasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>

        
        /* Reset dan Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --secondary: #f72585;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --card-bg: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            padding: 2rem 0;
            color: var(--light);
            line-height: 1.6;
            overflow-x: hidden;
            width: 100%;
        }

        /* Background Animation */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.15) 0%, rgba(67, 97, 238, 0) 70%);
            animation: float 20s infinite linear;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            top: 60%;
            left: 80%;
            animation-delay: 5s;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            top: 20%;
            left: 85%;
            animation-delay: 10s;
        }

        .circle-4 {
            width: 250px;
            height: 250px;
            top: 70%;
            left: 10%;
            animation-delay: 15s;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(20px, 30px) rotate(90deg);
            }
            50% {
                transform: translate(0, 60px) rotate(180deg);
            }
            75% {
                transform: translate(-20px, 30px) rotate(270deg);
            }
        }

        /* Container */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            position: relative;
            z-index: 1;
            width: 100%;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 4rem;
            padding: 3rem 2rem;
            border-radius: 24px;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
            transition: 0.8s;
        }

        .header:hover::before {
            left: 100%;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .logo-icon {
            font-size: 3rem;
            color: var(--accent);
            filter: drop-shadow(0 0 15px rgba(76, 201, 240, 0.4));
        }

        .header h1 {
            font-size: 2.8rem;
            margin-bottom: 0.75rem;
            background: linear-gradient(135deg, #ffffff 0%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }

        .header .subtitle {
            margin-top: 1rem;
            font-size: 1rem;
            opacity: 0.8;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .stat-card:hover::after {
            transform: translateX(100%);
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 1rem;
            position: relative;
            display: block;
        }

        .stat-divisi .stat-number {
            background: linear-gradient(135deg, var(--accent), var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-kuota .stat-number {
            background: linear-gradient(135deg, var(--accent), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-mahasiswa .stat-number {
            background: linear-gradient(135deg, var(--accent), #7209b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-sisa .stat-number {
            background: linear-gradient(135deg, var(--sisa-color), var(--sisa-color-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            font-size: 1.1rem;
            color: var(--light);
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .stat-label i {
            font-size: 1.3rem;
        }

        .stat-subtitle {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 0.5rem;
        }

        /* ===== SECTION TOMOL DI ATAS ===== */
        .action-section-top {
            margin-bottom: 3rem;
        }

        .action-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1.5rem;
            box-shadow: var(--shadow);
        }

        .action-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--accent), var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
            box-shadow: 0 8px 20px rgba(76, 201, 240, 0.3);
        }

        .action-text h3 {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 0.25rem;
        }

        .action-text p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .action-buttons-top {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.5);
        }
        /* ===== END SECTION TOMOL ===== */

        /* Section Title */
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .section-title h2 i {
            color: var(--accent);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
            border-radius: 2px;
        }

        /* Divisi Grid */
        .divisi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 2.5rem;
            margin-bottom: 5rem;
        }

        .divisi-card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--dark);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .divisi-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: var(--shadow-hover);
        }

        .divisi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .divisi-header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            gap: 1.5rem;
        }

        .divisi-icon-wrapper {
            flex-shrink: 0;
            width: 70px;
            height: 70px;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--card-color), var(--card-color-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .divisi-icon {
            font-size: 2.2rem;
            color: white;
        }

        .divisi-info {
            flex: 1;
        }

        .divisi-name {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .divisi-status {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            background: var(--status-bg);
            color: var(--status-color);
        }

        .divisi-desc {
            color: var(--gray);
            line-height: 1.7;
            margin-bottom: 2rem;
            flex-grow: 1;
            font-size: 1.05rem;
        }

        .divisi-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 2px dashed var(--light-gray);
            margin-top: auto;
        }

        .divisi-kuota {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .kuota-badge {
            background: linear-gradient(135deg, var(--card-color), var(--card-color-dark));
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 12px;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .duration {
            color: var(--gray);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Progress Bar */
        .kuota-progress {
            margin: 1.5rem 0;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
            color: var(--gray);
        }

        .progress-bar {
            height: 8px;
            background: var(--light-gray);
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--card-color), var(--card-color-dark));
            border-radius: 4px;
            transition: width 1s ease-in-out;
        }

        /* Info Container - DIPERBAIKI UNTUK HP */
        .info-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
            margin-bottom: 5rem;
        }

        .main-info {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--shadow);
            color: var(--dark);
        }

        .main-info h3 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .main-info h3 i {
            color: var(--accent);
        }

        .main-info p {
            margin-bottom: 2rem;
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--gray);
        }

        .benefits-list {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .benefits-list li {
            padding: 0.8rem 0;
            padding-left: 2.5rem;
            position: relative;
            font-size: 1.05rem;
            color: var(--dark);
            line-height: 1.6;
        }

        .benefits-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 0.8rem;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, var(--success), #20c997);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Sidebar - DIPERBAIKI UNTUK HP */
        .sidebar {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 24px;
            padding: 2.5rem;
            color: white;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
        }

        .sidebar h4 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar h4 i {
            color: var(--accent);
        }

        .contact-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            flex: 1;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.8rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .contact-item:last-child {
            border-bottom: none;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .contact-icon i {
            color: var(--accent);
            font-size: 1.2rem;
        }

        .contact-content {
            flex: 1;
            min-width: 0;
        }

        .contact-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .contact-detail {
            font-size: 1rem;
            line-height: 1.5;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        .contact-info {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 2px solid rgba(255, 255, 255, 0.1);
        }

        .contact-note {
            font-size: 0.95rem;
            opacity: 0.9;
            line-height: 1.6;
            padding: 0.8rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            margin-top: 1rem;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 3rem 0 2rem;
            border-top: 2px solid rgba(255, 255, 255, 0.1);
            margin-top: 3rem;
        }

        .footer p {
            opacity: 0.9;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .footer-link {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .footer-link:hover {
            opacity: 1;
            color: var(--accent);
            transform: translateY(-2px);
        }

        /* ============ RESPONSIVE FIX ============ */
        @media (max-width: 1200px) {
            .divisi-grid {
                grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            }
            .container {
                padding: 0 2rem;
            }
        }

        @media (max-width: 992px) {
            .container {
                padding: 0 1.75rem;
            }
            .info-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .sidebar {
                order: -1;
            }
            .main-info {
                padding: 2.5rem;
            }
            .header h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 1.5rem 0;
            }
            
            .container {
                padding: 0 1.25rem;
            }
            
            .header {
                padding: 2rem 1.25rem;
                margin-bottom: 2.5rem;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .header p {
                font-size: 1rem;
            }
            
            .logo-container {
                gap: 1rem;
            }
            
            .logo-icon {
                font-size: 2.5rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
                margin-bottom: 2.5rem;
            }
            
            .stat-card {
                padding: 1.75rem 1.25rem;
            }
            
            .stat-number {
                font-size: 2.8rem;
            }
            
            /* Action section responsive */
            .action-card {
                padding: 1.5rem;
                flex-direction: column;
                align-items: flex-start;
            }
            
            .action-info {
                gap: 1rem;
            }
            
            .action-icon {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }
            
            .action-text h3 {
                font-size: 1.3rem;
            }
            
            .action-buttons-top {
                width: 100%;
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .divisi-grid {
                grid-template-columns: 1fr;
                gap: 1.75rem;
                margin-bottom: 2.5rem;
            }
            
            .divisi-card {
                padding: 1.75rem;
            }
            
            .divisi-header {
                flex-direction: column;
                gap: 1rem;
            }
            
            .divisi-icon-wrapper {
                width: 60px;
                height: 60px;
            }
            
            .divisi-icon {
                font-size: 1.8rem;
            }
            
            .divisi-name {
                font-size: 1.5rem;
            }
            
            .divisi-desc {
                font-size: 0.95rem;
            }
            
            .main-info {
                padding: 1.75rem;
            }
            
            .main-info h3 {
                font-size: 1.6rem;
                margin-bottom: 1.25rem;
            }
            
            .main-info p {
                font-size: 0.95rem;
            }
            
            .benefits-list li {
                font-size: 0.95rem;
                padding-left: 2rem;
            }
            
            .benefits-list li::before {
                width: 20px;
                height: 20px;
                top: 0.7rem;
            }
            
            .sidebar {
                padding: 1.75rem;
            }
            
            .sidebar h4 {
                font-size: 1.3rem;
            }
            
            .contact-item {
                padding: 0.7rem 0;
            }
            
            .contact-detail {
                font-size: 0.95rem;
            }
            
            .contact-note {
                font-size: 0.9rem;
            }
            
            .footer {
                padding: 2rem 0 1.5rem;
            }
            
            .footer p {
                font-size: 0.95rem;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 0.75rem;
                align-items: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 1rem 0;
            }
            
            .container {
                padding: 0 1rem;
            }
            
            .header {
                padding: 1.5rem 1rem;
                margin-bottom: 2rem;
            }
            
            .header h1 {
                font-size: 1.6rem;
            }
            
            .logo-icon {
                font-size: 2rem;
            }
            
            .logo-container {
                gap: 0.75rem;
            }
            
            .stat-card {
                padding: 1.5rem 1rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
            
            .stat-label {
                font-size: 1rem;
            }
            
            .action-card {
                padding: 1.25rem;
            }
            
            .action-info {
                gap: 0.75rem;
            }
            
            .action-icon {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
            }
            
            .action-text h3 {
                font-size: 1.1rem;
            }
            
            .action-text p {
                font-size: 0.9rem;
            }
            
            .section-title h2 {
                font-size: 1.5rem;
            }
            
            .divisi-card {
                padding: 1.5rem;
            }
            
            .divisi-icon-wrapper {
                width: 55px;
                height: 55px;
            }
            
            .divisi-icon {
                font-size: 1.6rem;
            }
            
            .divisi-name {
                font-size: 1.3rem;
            }
            
            .divisi-status {
                font-size: 0.8rem;
            }
            
            .kuota-badge {
                padding: 0.4rem 1rem;
                font-size: 0.9rem;
            }
            
            .duration {
                font-size: 0.85rem;
            }
            
            .main-info {
                padding: 1.5rem;
            }
            
            .main-info h3 {
                font-size: 1.4rem;
                gap: 0.75rem;
            }
            
            .sidebar {
                padding: 1.5rem;
            }
            
            .sidebar h4 {
                font-size: 1.2rem;
            }
            
            .contact-item {
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }
            
            .contact-icon {
                width: 35px;
                height: 35px;
            }
            
            .contact-icon i {
                font-size: 1rem;
            }
            
            .contact-detail {
                font-size: 0.9rem;
                word-break: break-word;
            }
            
            .footer-links {
                gap: 0.5rem;
            }
            
            .footer-link {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 360px) {
            .container {
                padding: 0 0.75rem;
            }
            
            .header {
                padding: 1.25rem 0.75rem;
            }
            
            .header h1 {
                font-size: 1.4rem;
            }
            
            .logo-icon {
                font-size: 1.8rem;
            }
            
            .divisi-card {
                padding: 1.25rem;
            }
            
            .divisi-name {
                font-size: 1.2rem;
            }
            
            .contact-detail {
                font-size: 0.85rem;
                word-break: break-all;
            }
            
            .btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- Background Animation -->
    <div class="bg-animation">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
        <div class="bg-circle circle-4"></div>
    </div>

    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo-container">
                <i class="fas fa-city logo-icon"></i>
                <i class="fas fa-laptop-code logo-icon"></i>
                <i class="fas fa-chart-line logo-icon"></i>
            </div>
            <h1>Program Magang Diskominfosantik</h1>
            <p>Dinas Komunikasi, Informatika, dan Statistik Kota Bekasi</p>
            <p class="subtitle">Mengembangkan talenta digital untuk Smart City Bekasi</p>
        </header>

        <!-- Statistics Section -->
        <div class="stats-grid">
            @php
                // PERHITUNGAN YANG BENAR
                $total_divisi = $divisi->count();
                $total_kuota = $divisi->sum('kuota');
                
                // Hitung total mahasiswa dari semua divisi
                $total_mahasiswa_calculated = 0;
foreach($divisi as $d) {
    $total_mahasiswa_calculated += $d->mahasiswa->where('is_active', 1)->count();
}

                
                // Gunakan yang sudah dihitung jika $total_mahasiswa tidak ada
                $total_mahasiswa = $total_mahasiswa ?? $total_mahasiswa_calculated;
                
                // Hitung sisa kuota
                $sisa_kuota = $total_kuota - $total_mahasiswa;
                
                // Tentukan warna sisa kuota
                if($sisa_kuota > 0) {
                    $sisa_color = '#28a745';
                    $sisa_color_dark = '#20c997';
                    $sisa_icon = 'fa-check-circle';
                    $sisa_status = 'Tersedia';
                } else {
                    $sisa_color = '#dc3545';
                    $sisa_color_dark = '#f72585';
                    $sisa_icon = 'fa-times-circle';
                    $sisa_status = 'Penuh';
                }
            @endphp
            
            <div class="stat-card stat-divisi">
                <span class="stat-number">{{ $total_divisi }}</span>
                <div class="stat-label">
                    <i class="fas fa-th-large"></i>
                    <span>Divisi Tersedia</span>
                </div>
                <div class="stat-subtitle">Program magang aktif</div>
            </div>
            
            <div class="stat-card stat-kuota">
                <span class="stat-number">{{ $total_kuota }}</span>
                <div class="stat-label">
                    <i class="fas fa-users"></i>
                    <span>Total Kuota</span>
                </div>
                <div class="stat-subtitle">Kapasitas seluruh divisi</div>
            </div>
            
            <div class="stat-card stat-mahasiswa">
                <span class="stat-number">{{ $total_mahasiswa }}</span>
                <div class="stat-label">
                    <i class="fas fa-user-graduate"></i>
                    <span>Mahasiswa Aktif</span>
                </div>
                <div class="stat-subtitle">Sedang menjalani magang</div>
            </div>
            
            <div class="stat-card stat-sisa" style="--sisa-color: {{ $sisa_color }}; --sisa-color-dark: {{ $sisa_color_dark }};">
                <span class="stat-number">{{ $sisa_kuota }}</span>
                <div class="stat-label">
                    <i class="fas {{ $sisa_icon }}"></i>
                    <span>{{ $sisa_status }}</span>
                </div>
                <div class="stat-subtitle">Sisa kuota tersedia</div>
            </div>
        </div>

        <!-- ===== ACTION BUTTONS DIPINDAH KE ATAS ===== -->
        <div class="action-section-top">
            <div class="action-card">
                <div class="action-info">
                    <div class="action-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="action-text">
                        <h3>Informasi Pendaftaran</h3>
                        <p>Baca syarat, ketentuan, dan alur pendaftaran magang</p>
                    </div>
                </div>
                <div class="action-buttons-top">
                    <a href="/informasi" class="btn btn-primary">
                        <i class="fas fa-info-circle"></i>
                        Informasi Pendaftaran
                    </a>
                    <a href="/login" class="btn btn-secondary">
                        <i class="fas fa-lock"></i>
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
        <!-- ===== END ACTION BUTTONS ===== -->

        <!-- Divisi Section -->
        <div class="section-title">
            <h2><i class="fas fa-th-large"></i> Divisi Magang Tersedia</h2>
        </div>
        
        <div class="divisi-grid">
            @foreach($divisi as $d)
@php
    $div = [];
    $div['nama'] = $d->nama_divisi;
    $div['deskripsi'] = $d->deskripsi;
    $div['kuota'] = $d->kuota;
    $div['mahasiswa'] = $d->mahasiswa()->where('is_active', 1)->count();

    // ICON & WARNA BIAR TETAP CANTIK (auto muter)
    $icons = [
        'fas fa-palette',
        'fas fa-chart-bar',
        'fas fa-laptop-code',
        'fas fa-shield-alt',
        'fas fa-mobile-alt',
        'fas fa-database'
    ];

    $colors = [
        ['#f72585','#b5179e'],
        ['#4cc9f0','#3a0ca3'],
        ['#4361ee','#3a0ca3'],
        ['#28a745','#1e7e34'],
        ['#ff9e00','#cc7e00'],
        ['#6f42c1','#5a32a3']
    ];

    $div['icon'] = $icons[$loop->index % count($icons)];
    $div['color'] = $colors[$loop->index % count($colors)][0];
    $div['color_dark'] = $colors[$loop->index % count($colors)][1];

    $percentage = $div['kuota'] > 0 ? ($div['mahasiswa'] / $div['kuota']) * 100 : 0;
    $sisa = $div['kuota'] - $div['mahasiswa'];

    if($sisa == 0){
        $status = 'Penuh';
        $status_color = '#dc3545';
        $status_bg = 'rgba(220, 53, 69, 0.1)';
    } elseif($percentage >= 80){
        $status = 'Hampir Penuh';
        $status_color = '#ffc107';
        $status_bg = 'rgba(255, 193, 7, 0.1)';
    } else {
        $status = 'Tersedia';
        $status_color = '#28a745';
        $status_bg = 'rgba(40, 167, 69, 0.1)';
    }
@endphp

                
                
                <div class="divisi-card" style="--card-color: {{ $div['color'] }}; --card-color-dark: {{ $div['color_dark'] }}; --status-bg: {{ $status_bg }}; --status-color: {{ $status_color }};">
                    <div class="divisi-header">
                        <div class="divisi-icon-wrapper">
                            <i class="{{ $div['icon'] }} divisi-icon"></i>
                        </div>
                        <div class="divisi-info">
                            <h3 class="divisi-name">{{ $div['nama'] }}</h3>
                            <div class="divisi-status">
                                {{ $status }} ({{ $div['mahasiswa'] }}/{{ $div['kuota'] }})
                            </div>
                        </div>
                    </div>
                    
                    <p class="divisi-desc">{{ $div['deskripsi'] }}</p>
                    
                    <div class="kuota-progress">
                        <div class="progress-info">
                            <span>Kuota Terisi: {{ $div['mahasiswa'] }} dari {{ $div['kuota'] }}</span>
                            <span>{{ number_format($percentage, 1) }}%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo $percentage; ?>%;"></div>
                        </div>
                    </div>
                    
                    <div class="divisi-footer">
                        <div class="kuota-badge">
                            <i class="fas fa-user-graduate"></i>
                            <span>Kuota: {{ $div['kuota'] }}</span>
                        </div>
                        <div class="duration">
                            <i class="fas fa-clock"></i>
                            <span>3-6 Bulan</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Info Section -->
        <div class="info-container">
            <div class="main-info">
                <h3><i class="fas fa-info-circle"></i> Tentang Diskominfosantik</h3>
                <p>
                    Dinas Komunikasi, Informatika, dan Statistik Kota Bekasi merupakan leading sector 
                    dalam transformasi digital menuju Smart City. Kami membuka kesempatan magang 
                    bagi mahasiswa untuk berkontribusi dalam proyek-proyek digital pemerintahan.
                </p>
                
                <h3 style="margin-top: 2rem;"><i class="fas fa-graduation-cap"></i> Keuntungan Magang</h3>
                <ul class="benefits-list">
                    <li>Sertifikat magang resmi dari Pemerintah Kota Bekasi</li>
                    <li>Pengalaman kerja langsung di proyek Smart City</li>
                    <li>Bimbingan dari profesional IT pemerintahan</li>
                    <li>Jaringan profesional di sektor pemerintahan</li>
                    <li>Peluang karir di instansi pemerintah</li>
                    <li>Fasilitas kerja lengkap dan modern</li>
                </ul>
            </div>
            
            <div class="sidebar">
                <h4><i class="fas fa-headset"></i> Kontak & Informasi</h4>
                
                <div class="contact-grid">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-content">
                            <div class="contact-title">Email</div>
                            <div class="contact-detail">magang@diskominfosantik.bekasikota.go.id</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-content">
                            <div class="contact-title">Telepon</div>
                            <div class="contact-detail">(021) 8895-1234 ext. 456</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-content">
                            <div class="contact-title">Alamat</div>
                            <div class="contact-detail">Gedung Diskominfosantik, Komplek Perkantoran Pemerintah Kabupaten Bekasi, Desa Sukamahi, Kecamatan Cikarang Pusat, Kabupaten Bekasi, Jawa Barat 17530.</div>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-content">
                            <div class="contact-title">Jam Kerja</div>
                            <div class="contact-detail">Senin-Jumat, 08:00 - 15:30 WIB</div>
                        </div>
                    </div>
                </div>
                
                <div class="contact-info">
                    <h4><i class="fas fa-question-circle"></i> Pertanyaan?</h4>
                    <p class="contact-note">
                        Baca Terlebih Dahulu Ketentuan dan Informasi Pada Tombol Informasi Pendaftaran di atas. Hubungi kami untuk informasi lebih lanjut tentang program magang. 
                        Kami siap membantu Anda dari Senin hingga Jumat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2024 Dinas Komunikasi, Informatika, dan Statistik Kota Bekasi</p>
            <p>Diskominfosantik Bekasi, Komplek Pemkab Bekasi, Cikarang Pusat – 17530</p>
            
            <div class="footer-links">
                <a href="https://bekasikota.go.id" target="_blank" class="footer-link">
                    <i class="fas fa-globe"></i>
                    Website Resmi
                </a>
                <a href="https://instagram.com/diskominfosantik.bekasi" target="_blank" class="footer-link">
                    <i class="fab fa-instagram"></i>
                    Instagram
                </a>
                <a href="https://facebook.com/diskominfosantikbekasi" target="_blank" class="footer-link">
                    <i class="fab fa-facebook"></i>
                    Facebook
                </a>
                <a href="https://twitter.com/diskominfobekasi" target="_blank" class="footer-link">
                    <i class="fab fa-twitter"></i>
                    Twitter
                </a>
                <a href="https://youtube.com/@diskominfosantikbekasi" target="_blank" class="footer-link">
                    <i class="fab fa-youtube"></i>
                    YouTube
                </a>
            </div>
        </footer>
    </div>

    <script>
        // Animasi untuk statistik
        document.addEventListener('DOMContentLoaded', function() {
            // Counter animation untuk statistik
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const finalValue = parseInt(stat.textContent);
                if (!isNaN(finalValue) && finalValue > 0) {
                    let current = 0;
                    const increment = finalValue / 100;
                    const duration = 1500;
                    const stepTime = duration / 100;
                    
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= finalValue) {
                            stat.textContent = finalValue.toLocaleString();
                            clearInterval(timer);
                        } else {
                            stat.textContent = Math.floor(current).toLocaleString();
                        }
                    }, stepTime);
                }
            });
            
            // Progress bar animation
            const progressBars = document.querySelectorAll('.progress-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
            
            // Hover effect untuk cards
            const cards = document.querySelectorAll('.divisi-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.zIndex = '10';
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.zIndex = '1';
                });
            });
        });
    </script>
</body>
</html>