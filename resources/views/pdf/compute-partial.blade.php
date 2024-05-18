<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Compute Partial Amount</title>
    <link rel="stylesheet" href="{{ asset('admin/css/pdf.css') }}">
</head>


<body>
    <header>
        <div class="logo-container">
            <div class="image-container">
                <img src="{{ asset('images/logo/nav-logo.png') }}" alt="Nav Logo">
            </div>
            <div class="brand-container">
                <p>Car Rental Management System</p>
            </div>
        </div>

        <div class="header-info">
            <ul>
                <li>Computed as of {{ now()->format('M d, Y') }}</li>
            </ul>
        </div>
    </header>

    <div class="main-title">
        <h3>Partial Amount</h3>
    </div>

    <div class="details-container">
        <div class="detail-row">
            <div class="item">
                <p>Customer Name: </p><span>{{ $rental->user->name }}</span>
            </div>
            <div class="item">
                <p>Car Details: </p> <span>{{ $rental->car->category->name }} - {{ $rental->car->brand->name }} -
                    {{ $rental->car->model }} - ₱{{ $rental->car->price_per_day }}</span>
            </div>
            <div class="item">
                <p>Status : </p><small
                    class="badge-{{ $rental->status == 'Active' ? 'primary' : 'warning' }}">Active</small>
            </div>
        </div>

        <div class="detail-row">
            <div class="item">
                <p>Reservation Date: </p> <span>{{ $rental->created_at }}</span>
            </div>
            <div class="item">
                <p>Date Approved: </p><span>{{ $rental->date_approved }}</span>
            </div>

        </div>

        <div class="detail-row">
            <div class="item">
                <p>Start Date</p> <span>{{ $rental->start_date }}</span>
            </div>
            <div class="item">
                <p>End Date: </p> <span>{{ $rental->end_date }}</span>
            </div>

        </div>
    </div>

    <div class="table-container">
        <table style="width:100%">
            <thead>
                <thead>
                    <tr>
                        <th>Rental Days</th>
                        <th>Amount</th>
                        <th>Overdue Days</th>
                        <th>Penalties</th>

                    </tr>
                </thead>
            <tbody>
                <tr>
                    <td>{{ $days }}</td>
                    <td>{{ $amount }}</td>
                    <td>{{ $over_due_days }}</td>
                    <td>{{ $penalty_amount }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="computed-container">
        <div class="item">
            <p>Penalties: </p><span>{{ $penalty_amount }}</span>
        </div>
        <div class="item">
            <p>Amount: </p><span>{{ $amount }}</span>
        </div>
        <div class="item">
            <p>Total :</p><span>{{ $total_amount }}</span>
        </div>
    </div>

    <div class="footer">
        <p>Copyright 2024 CRMS</p>
    </div>
</body>

</html>
