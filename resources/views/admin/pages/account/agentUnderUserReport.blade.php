

{{--@endsection--}}
@extends('admin.app')
@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">My User</a></li>
                        <li class="breadcrumb-item active">My User!</li>
                    </ol>
                </div>
                <h4 class="page-title">My User!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="header-title">Filter Orders</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button style="background-color:darkblue;" class="btn text-nowrap text-light"
                        onclick="exportTableToPDF('agent-under-order-report.pdf', 'Order Report')">
                    Download Report
                </button>
                <form action="{{ route('agent.under.user.report') }}" method="GET">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                       value="{{ request('start_date') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                       value="{{ request('end_date') }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label invisible">Filter</label>
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Order Invoice</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Total Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key => $order)
                        @php
                            $orderAmount = $order->total - $coupon->discount_amount;
                            $totalAmount += $orderAmount;
                        @endphp
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$order->invoice_no }}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->user->email}}</td>
                            <td>{{$order->user->phone}}</td>
                            <td>{{$order->user->address}}</td>
                            <td>{{$order->total - $coupon->discount_amount}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-end fw-bold">Total Commission ({{$commissionPercent}}%):</td>
                    <td class="fw-bold">৳ {{ number_format(($totalAmount * $commissionPercent) / 100, 2) }}</td>
                </tr>
                </tfoot>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script>
        function exportTableToPDF(filename, heading) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            doc.text(heading, doc.internal.pageSize.getWidth() / 2, 20, { align: 'center' });
            let rows = document.querySelectorAll("table tr");
            let data = [];
            for (let i = 0; i < rows.length; i++) {
                let row = [],
                    cols = rows[i].querySelectorAll("td, th");
                for (let j = 0; j < cols.length; j++)  // <- Fixed here
                    row.push(cols[j].innerText);
                data.push(row);
            }
            doc.autoTable({
                head: [data[0]],
                body: data.slice(1),
                startY: 30
            });
            doc.save(filename);
        }
    </script>
@endsection
