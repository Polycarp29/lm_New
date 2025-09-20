<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <section>
        <div
            style="margin: 1.5rem auto; padding: 3rem; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; border-radius: 0.5rem;">
            <!-- Header -->
            <div
                style="margin: 1rem; display: flex; justify-content: space-between; background-color: #e5e7eb; padding: 1rem; border-radius: 0.375rem;">
                {{-- Activate On Server --}}
                {{-- <div style="display: flex; align-items: center;">
                    @php
                        $imagePath = public_path('assets/images/logo.png');
                    @endphp
                    <img style="height: 80px; width: 80px;" src="{{$imagePath}}" alt="" />
                </div> --}}
                <div style="text-align: right;">
                    <div style="font-size: 1.25rem; font-weight: bold;">Reciept #{{ $newInvoiceNumber }}</div>
                    <div style="font-size: 0.875rem;">Date: {{ date('F d, Y') }}</div>
                </div>
            </div>

            <!-- Recipient and Sender Information -->
            <div style="display: flex; justify-content: space-between; margin: 2rem;">
                @foreach ($userDetails as $details)
                    @if ($details)
                        <div>
                            <h3 style="font-size: 1.125rem; font-weight: 600;">Paid To:</h3>
                            <p style="font-size: 0.875rem;">{{ $details->fname . ' ' . $details->lname }}</p>
                            <p style="font-size: 0.875rem;">Phone No. {{ $details->phone_number }}</p>
                            <p style="font-size: 0.875rem;">ID No. {{ $details->id_number }}</p>
                            <p style="font-size: 0.875rem;">Email:
                                {{ \App\Models\User::where('id', $details->user_id)->value('email') }}</p>
                        </div>
                    @else
                        <div style="font-size: 1.125rem; font-weight: 600; padding: 2rem; background-color: #fecaca;">
                            <p>User Profile Details not Found</p>
                        </div>
                    @endif
                @endforeach
                @foreach ($companyDetails as $data)
                    <div style="text-align: right;">
                        <h3 style="font-size: 1.125rem; font-weight: 600;">From:</h3>
                        <p style="font-size: 0.875rem;">{{ $data->company_name }}</p>
                        <p style="font-size: 0.875rem;">
                            {{ $data->postal_code . ' ' . $data->city . ' ' . $data->country }}
                        </p>
                        <p style="font-size: 0.875rem;">{{ $data->state }}</p>
                        <p style="font-size: 0.875rem;">{{ $data->email }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Invoice Items Table -->
            <div style="margin: 2rem;">
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #d1d5db;">
                    <thead>
                        <tr style="background-color: #fee2e2;">
                            <th style="border: 1px solid #d1d5db; padding: 1rem; text-align: left;">Payment ID</th>
                            <th style="border: 1px solid #d1d5db; padding: 1rem; text-align: center;">Task Description
                            </th>
                            <th style="border: 1px solid #d1d5db; padding: 1rem; text-align: center;">Payment Amount
                            </th>
                            <th style="border: 1px solid #d1d5db; padding: 1rem; text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach ($generate as $payd)
                            <tr>
                                @if ($payd->payments)
                                    <td style="border: 1px solid #d1d5db; padding: 1rem;">
                                        {{ $payd->payments->transaction_id }}</td>
                                @endif
                                <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: center;">
                                    {{ $payd->task_name }}
                                    <span
                                        style="font-size: 1rem; font-weight: bold; color: #6b7280;">{{ $payd->company_issuer }}</span>
                                </td>
                                @if ($payd->payments)
                                    <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: center;">
                                        {{ $payd->payments->currency . ' ' . $payd->payments->amount }}
                                    </td>
                                    <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: right;">
                                        {{ $payd->payments->currency . ' ' . $payd->payments->amount }}
                                    </td>
                                    @php
                                        $subtotal += $payd->payments->amount;
                                    @endphp
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @php
                            $taxRate = 0.0; // Tax rate
                            $tax = $subtotal * $taxRate; // Calculate tax
                            $total = $subtotal + $tax; // Calculate total
                        @endphp
                        <tr style="background-color: #fee2e2;">
                            <td colspan="3"
                                style="border: 1px solid #d1d5db; padding: 1rem; text-align: right; font-weight: bold;">
                                Subtotal</td>
                            <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: right;">
                                {{ 'KES' . number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"
                                style="border: 1px solid #d1d5db; padding: 1rem; text-align: right; font-weight: bold;">
                                Tax ({{ $taxRate * 100 }}%)</td>
                            <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: right;">
                                {{ 'KES' . number_format($tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"
                                style="border: 1px solid #d1d5db; padding: 1rem; text-align: right; font-weight: bold;">
                                Total</td>
                            <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: right;">
                                {{ 'KES' . number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Payment Instructions -->
            <div style="margin: 2rem;">
                <h3 style="font-size: 1.125rem; font-weight: 600;">Payment Details:</h3>
                <p style="font-size: 0.875rem;">Payment was made to:</p>
                @foreach($accountDetails as $detail)
                    @if($detail->methods === 'Bank')
                        <p style="font-size: 0.875rem;">Bank Name: <span style="color:grey; font-weight: bold;">{{ $detail->bank_name }}</span></p>
                        <p style="font-size: 0.875rem;">Account Number: {{ $detail->account_number }}</p>
                    @elseif($detail->methods === 'Mpesa')
                        <p style="font-size: 0.875rem;">Mpesa</p>
                        <p style="font-size: 0.875rem;">Mpesa Number: {{ $detail->mpesa_number }}</p>
                    @elseif($detail->methods === 'Paypal')
                        <p style="font-size: 0.875rem;">Paypal</p>
                        <p style="font-size: 0.875rem;">Paypal Email: {{ $detail->paypal_email }}</p>
                    @else
                        <div>
                            Account Details Not Set
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- Footer -->
            <div
                style="margin-top: 3rem; text-align: right; font-size: 0.875rem; color: #6b7280; font-style: italic; padding: 1rem;">
                <p>Lee Marketing Services!</p>
                <p>If you have any questions about this invoice, please contact us at info@leemarketingservices.com.</p>
            </div>
        </div>
    </section>

</body>

</html>
