@extends('admin.app')
@section('admin_content')
    <style>
        .section-title {
            background-color: #f0f8ff;
            padding: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .resume-header {
            background-color: #e8f4fc;
            padding: 15px;
            text-align: center;
        }

        .contact-info, .personal-info, .skills, .projects, .education, .experience, .certificates {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #ffffff;
        }

        .profile-image {
            width: 200px;
            height: 200px;;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .no-pdf {
            display: block;
        }

        .no-pdf-hidden {
            display: none !important;
        }
        .contact-info a {
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
            overflow-wrap: break-word;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 printable">
        <div class="row content">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Invoice Logo-->
                        <div class="clearfix">
                            @if($siteSetting !=null)
                                <div class="float-start mb-3">
                                    <img src="{{asset($siteSetting->logo)}}" alt="dark logo" height="70">
                                </div>
                            @endif
                            <div class="float-end">
                                <h4 class="m-0 d-print-none">Invoice</h4>
                            </div>
                        </div>
                        <!-- Invoice Detail-->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="float-end mt-3">
                                    <h3><b>{{$order->user->name}}</b></h3>
                                    <p>
                                        Please review your invoice carefully and ensure all details are correct. If you have
                                        any
                                        questions or notice any discrepancies, please contact us.
                                    </p>
                                </div>

                            </div>
                            <div class="col-sm-4 offset-sm-2">
                                <div class="mt-3 float-sm-end">
                                    <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp;
                                        {{ date('d-m-Y', strtotime($order->created_at)) }}
                                    </p>

                                    <p class="fs-13"><strong>Payment Status: </strong>
                                        <span class="badge bg-success text-dark">Paid</span>
                                    </p>

                                    <p class="fs-13"><strong>Invoice : &nbsp;&nbsp; </strong> <span
                                            class="float-end">{{$order->invoice_no}}</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-6">
                                <h4>Contact Information</h4><br>
                                <address>
                                    <p>Phone:&nbsp;&nbsp; +88{{$siteSetting->phone}}</p>
                                    <p>Email:&nbsp;&nbsp; {{$siteSetting->email}}</p>
                                </address>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                        <thead class="border-top border-bottom bg-light-subtle border-light">
                                        <tr style="border-top: 1px solid #ddd;">
                                            <th>S/N</th>
                                            <th>Product Name</th>
                                            <th>Duration</th>
                                            <th>Device Access</th>
                                            <th>Type</th>
                                            <th>Price</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($order)
                                            @foreach($order->orderItems as $key => $item)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item->name}}</td>
                                                    <td>
                                                        @if($item->type=='product')
                                                            {{$item->duration}} Month
                                                        @else
                                                            @if($item->duration == 'Monthly')
                                                                {{$item->duration}}
                                                            @elseif($item->duration == 'Half Yearly')
                                                                {{$item->duration}}
                                                            @elseif($item->duration == 'Yearly')
                                                                {{$item->duration}}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>{{$item->device_access}}</td>
                                                    <td>{{$item->type=='product'? 'Product' : 'Package'}}</td>
                                                    <td>{{$item->price}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6">No order found.</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="clearfix pt-3">
                                    <h6 class="">Notes:</h6>
                                    <small>
                                        All accounts are to be paid within 7 days from receipt of
                                        invoice. To be paid by cheque or credit card or direct payment
                                        online. If account is not paid within 7 days the credits details
                                        supplied as confirmation of work undertaken will be charged the
                                        agreed quoted fee noted above.
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="d-print-none mt-4">
                            <div class="d-flex justify-content-center">
                                <div class="btn-group">
                                    <div class="text-right mb-3">
                                        <button onclick="downloadPDF()" class="btn btn-primary no-pdf">Invoice Download</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.querySelector('.printable'); // Select the content to convert to PDF
            const button = document.querySelector('.no-pdf'); // Select the button to hide

            // Hide the button
            button.classList.add('no-pdf-hidden');

            const options = {
                margin: 0.5,
                filename: 'Invoice.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            html2pdf()
                .set(options)
                .from(element)
                .save()
                .then(() => {
                    // Show the button back after PDF generation
                    button.classList.remove('no-pdf-hidden');
                });
        }

    </script>

@endsection



