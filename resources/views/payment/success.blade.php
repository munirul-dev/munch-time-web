<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Success</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <style>
        .print {
            display: none;
            visibility: hidden;
        }

        @media print {
            .print {
                display: block;
                visibility: visible;
            }

            .noprint {
                display: none;
                visibility: hidden;
            }
        }
    </style>
</head>

<body class="p-4">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-8 col-xl-6">
            <div class="card">

                <div class="card-header">
                    <div style="padding: 0px 35%;">
                        <img class="w-100 rounded" src="{{ asset('senangpay.png') }}" alt="logo">
                    </div>
                </div>

                <div class="card-body pb-0">
                    <div class="row">

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Transaction Status</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">
                            @if ($data['txn_status'] == 1)
                                <span class="badge rounded-pill bg-success noprint">Success</span>
                                <p class="text-success font-weight-bold print">Success</p>
                            @else
                                <span class="badge rounded-pill bg-danger noprint">Failed</span>
                                <p class="text-danger font-weight-bold print">Failed</p>
                            @endif
                        </div>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Name</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">{{ $data['name'] }}</div>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Email Address</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">{{ $data['email'] }}</div>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Phone Number</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">{{ $data['phone'] }}</div>

                        <hr>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Transaction Time</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">{{ date('d/m/Y h:i A', strtotime($data['payment']['updated_at'])) }}</div>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Transaction Amount</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">RM {{ number_format($data['amount'], 2) }}</div>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Transaction ID</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">{{ $data['txn_ref'] }}</div>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Reference No</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">{{ $data['order_id'] }}</div>

                        <div class="col-6 d-flex justify-content-between">
                            <p style="font-weight: bold;">Payment Method</p>
                            <p style="font-weight: bold;">:</p>
                        </div>
                        <div class="col-6">{{ $data['txn_type'] == 'cc' ? 'Debit / Credit Card' : 'FPX' }}</div>

                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between noprint">
                    <a href="{{ $data['action_back'] }}" class="btn btn-secondary">
                        <i class="fas fa-reply"></i> &nbsp; Back
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
