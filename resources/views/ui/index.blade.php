<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UI Components</title>

    <link rel="icon" href="{{ asset('favicon.svg') }}" sizes="any" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: var(--surface-1);
            color: var(--text-1);

            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .box {
            inline-size: 6rem;
            block-size: 6rem;
            border-radius: 1rem;
            margin: 2rem;

            display: grid;
            place-items: center;
        }

        .surface {
            color: var(--text-1);
            border: 1px solid var(--text-2);
        }

        .surface.no-1 {
            background-color: var(--surface-1);
        }

        .surface.no-2 {
            background-color: var(--surface-2);
        }

        .surface.no-3 {
            background-color: var(--surface-3);
        }

        .primary-brushes {
            color: var(--text-on-primary);
        }

        .primary-brushes.no-1 {
            background-color: var(--primary-brush-1);
        }

        .primary-brushes.no-2 {
            background-color: var(--primary-brush-2);
        }

        .primary-brushes.light {
            background-color: var(--primary-brush-light);
            color: var(--text-on-primary-light);
        }

        .secondary-brushes {
            color: var(--text-on-secondary);
        }

        .secondary-brushes.no-1 {
            background-color: var(--secondary-brush-1);
        }

        .secondary-brushes.no-2 {
            background-color: var(--secondary-brush-2);
        }

        .secondary-brushes.light {
            background-color: var(--secondary-brush-light);
            color: var(--text-on-secondary-light);
        }

        .danger-brushes {
            color: var(--text-on-danger);
        }

        .danger-brushes.no-1 {
            background-color: var(--danger-brush-1);
        }

        .danger-brushes.no-2 {
            background-color: var(--danger-brush-2);
        }

        .danger-brushes.light {
            background-color: var(--danger-brush-light);
            color: var(--text-on-danger-light);
        }

        .warning-brushes {
            color: var(--text-on-warning);
        }

        .warning-brushes.no-1 {
            background-color: var(--warning-brush-1);
        }

        .warning-brushes.no-2 {
            background-color: var(--warning-brush-2);
        }

        .warning-brushes.light {
            background-color: var(--warning-brush-light);
            color: var(--text-on-warning-light);
        }

        .success-brushes {
            color: var(--text-on-success);
        }

        .success-brushes.no-1 {
            background-color: var(--success-brush-1);
        }

        .success-brushes.no-2 {
            background-color: var(--success-brush-2);
        }

        .success-brushes.light {
            background-color: var(--success-brush-light);
            color: var(--text-on-success-light);
        }
    </style>
</head>
<body>
    <section>
        <h3>Surface Brushes</h3>
        <section>
            <div class="box surface no-1">Box #1</div>
            <div class="box surface no-2">Box #2</div>
            <div class="box surface no-3">Box #3</div>
        </section>
    </section>

    <section>
        <h3>Primary Brushes</h3>
        <section>
            <div class="box primary-brushes no-1">Box #1</div>
            <div class="box primary-brushes no-2">Box #2</div>
            <div class="box primary-brushes light">Box #3</div>
        </section>
    </section>

    <section>
        <h3>Secondary Brushes</h3>
        <section>
            <div class="box secondary-brushes no-1">Box #1</div>
            <div class="box secondary-brushes no-2">Box #2</div>
            <div class="box secondary-brushes light">Box #3</div>
        </section>
    </section>

    <section>
        <h3>Success Brushes</h3>
        <section>
            <div class="box success-brushes no-1">Box #1</div>
            <div class="box success-brushes no-2">Box #2</div>
            <div class="box success-brushes light">Box #3</div>
        </section>
    </section>

    <section>
        <h3>Warning Brushes</h3>
        <section>
            <div class="box warning-brushes no-1">Box #1</div>
            <div class="box warning-brushes no-2">Box #2</div>
            <div class="box warning-brushes light">Box #3</div>
        </section>
    </section>

    <section>
        <h3>Danger Brushes</h3>
        <section>
            <div class="box danger-brushes no-1">Box #1</div>
            <div class="box danger-brushes no-2">Box #2</div>
            <div class="box danger-brushes light">Box #3</div>
        </section>
    </section>

    <section>
        <h3>Buttons</h3>
        <section>
            <button class="btn btn-primary">Button</button>
            <button class="btn btn-secondary">Button</button>
            <button class="btn btn-success">Button</button>
            <button class="btn btn-warning">Button</button>
            <button class="btn btn-danger" disabled>Button (Disabled)</button>
        </section>
    </section>
    <section>
        <h3>Link</h3>
        <section>
            <a href="#" class="btn btn-primary">Button</a>
            <a href="#" class="btn btn-secondary">Button</a>
            <a href="#" class="btn btn-success">Button</a>
            <a href="#" class="btn btn-warning">Button</a>
            <a href="#" class="btn btn-danger">Button</a>
        </section>
    </section>
    <section>
        <h3>Table</h3>
        <section>
            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Hostname or IP</th>
                    <th>Number of Keys</th>
                    <th>Total Usage</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>Netherlands</td>
                    <td>nth.free.internet.com</td>
                    <td><span class="status status-secondary">5</span></td>
                    <td><span class="status status-warning">202MB</span></td>
                    <td><span class="status status-danger">Not Available</span></td>
                    <td><button class="btn btn-danger">MANAGE</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>USA</td>
                    <td>usa.free.internet.com</td>
                    <td><span class="status status-secondary">2</span></td>
                    <td><span class="status status-warning">2.09GB</span></td>
                    <td><span class="status status-success">Available</span></td>
                    <td><a href="#" class="btn">MANAGE</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>UK</td>
                    <td>uk.free.internet.com</td>
                    <td><span class="status status-secondary">12</span></td>
                    <td><span class="status status-warning">21.78GB</span></td>
                    <td><span class="status status-success">Available</span></td>
                    <td><a href="#" class="btn">MANAGE</a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Iran</td>
                    <td>ir.free.internet.com</td>
                    <td><span class="status status-secondary">6</span></td>
                    <td><span class="status status-warning">1.6GB</span></td>
                    <td><span class="status status-success">Available</span></td>
                    <td><a href="#" class="btn btn-primary">MANAGE</a></td>
                </tr>
                </tbody>
            </table>
    </section>
</body>
</html>
