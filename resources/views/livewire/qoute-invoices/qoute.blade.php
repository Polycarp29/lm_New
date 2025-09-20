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
                    <div style="font-size: 1.25rem; font-weight: bold;">Reciept #</div>
                    <div style="font-size: 0.875rem;">Date: {{ date('F d, Y') }}</div>
                </div>
            </div>

            <!-- Recipient and Sender Information -->


            <!-- Invoice Items Table -->
            <div style="margin: 2rem;">
                <table style="width: 100%; border-collapse: collapse; border: 1px solid #d1d5db;">
                    <thead>
                        <tr style="background-color: #fee2e2;">
                            <th style="border: 1px solid #d1d5db; padding: 1rem; text-align: left;">Service ID</th>
                            <th style="border: 1px solid #d1d5db; padding: 1rem; text-align: center;">Service
                                Description
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

                        <tr>

                            <td style="border: 1px solid #d1d5db; padding: 1rem;">
                                {{ $serviceId }}</td>

                            <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: center;">
                                {{ strip_tags($serviceDescription) }}
                                <span style="font-size: 1rem; font-weight: bold; color: #6b7280;"></span>
                            </td>

                            <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: center;">
                                {{ 'KES' . ' ' . $serviceprice }}
                            </td>
                            <td style="border: 1px solid #d1d5db; padding: 1rem; text-align: right;">
                                {{ 'KES' . ' ' . $serviceprice }}
                            </td>
                            @php
                                $subtotal += $serviceprice;
                            @endphp
                        </tr>
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
