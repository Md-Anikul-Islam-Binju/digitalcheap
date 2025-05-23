@extends('admin.app')

@section('admin_content')
    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Report</a></li>
                        <li class="breadcrumb-item active">Report!</li>
                    </ol>
                </div>
                <h4 class="page-title">Report!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button style="background-color:darkblue;" class="btn text-nowrap text-light"
                        onclick="exportTableToPDF('order-report.pdf', 'Order Report')">
                    Download Report
                </button>
                <form action="{{ route('report') }}" method="get" class="d-flex flex-wrap align-items-end gap-2">
                    <div>
                        <label for="from_date" class="form-label mb-0">From Date</label>
                        <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>

                    <div>
                        <label for="to_date" class="form-label mb-0">To Date</label>
                        <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>

                    <div>
                        <label for="type" class="form-label mb-0">Order Type</label>
                        <select name="type" id="type" class="form-select">
                            <option value="">All</option>
                            <option value="product" {{ request('type') == 'product' ? 'selected' : '' }}>Product</option>
                            <option value="package" {{ request('type') == 'package' ? 'selected' : '' }}>Package</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                    </div>
                </form>
                <!-- Button to download the PDF report -->



            </div>


            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Device Access</th>
                        <th>Free Or Paid</th>
                        <th>Total</th>
                        <th>After Discount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $grandTotal = 0;
                        $grandFinalTotal = 0;
                    @endphp

                    @foreach($report as $key => $order)
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->type=='product'? 'Product' : 'Package'}}</td>
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
                                <td>
                                    @if($item->type=='product')
                                        {{$item->is_free_or_paid=='paid'? 'Paid' : 'Free'}}
                                    @else
                                        @if($item->is_free_or_paid == 'buy')
                                            Paid
                                        @elseif($item->is_free_or_paid == 'free')
                                            Free
                                        @endif
                                    @endif

                                </td>

                                @if($item->type=='product')
                                    <td>{{$item->price * $item->duration}}</td>
                                @else
                                    @if($item->duration == 'Monthly')
                                        <td>{{$item->price * 1}}</td>
                                    @elseif($item->duration == 'Half Yearly')
                                        <td>{{$item->price * 6}}</td>
                                    @elseif($item->duration == 'Yearly')
                                        <td>{{$item->price * 12}}</td>
                                    @endif
                                @endif

                                @php
                                    $baseTotal = 0;
                                    if ($item->type == 'product') {
                                        $baseTotal = $item->price * $item->duration;
                                    } else {
                                        if ($item->duration == 'Monthly') {
                                            $baseTotal = $item->price * 1;
                                        } elseif ($item->duration == 'Half Yearly') {
                                            $baseTotal = $item->price * 6;
                                        } elseif ($item->duration == 'Yearly') {
                                            $baseTotal = $item->price * 12;
                                        }
                                    }
                                   $grandTotal += $baseTotal;

                                    $finalTotal = $baseTotal;
                                    if ($order->coupon_code && $order->coupon && $order->coupon->discount_amount) {
                                        $finalTotal = max(0, $baseTotal - $order->coupon->discount_amount); // Prevent negative values
                                    }
                                    $grandFinalTotal += $finalTotal;
                                @endphp
                                <td>{{ number_format($finalTotal, 2) }}</td>

                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6" style="text-align: right;"><strong>Grand Total:</strong></td>
                        <td><strong>{{ number_format($grandTotal, 2) }}</strong></td>
                        <td><strong>{{ number_format($grandFinalTotal, 2) }}</strong></td>
                    </tr>
                    </tfoot>
                </table>
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
