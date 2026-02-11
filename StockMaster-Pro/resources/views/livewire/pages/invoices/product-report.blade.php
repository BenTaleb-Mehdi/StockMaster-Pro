<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* Preline Inspired Colors & Typography */
        body { 
            font-family: 'Helvetica', sans-serif; 
            font-size: 13px; 
            color: #1f2937; 
            margin: 0; 
            padding: 20px;
        }
        .container { max-width: 800px; margin: auto; }
        
        /* Header */
        .header { 
            border-bottom: 1px solid #e5e7eb; 
            padding-bottom: 20px; 
            margin-bottom: 30px; 
            display: table; 
            width: 100%; 
        }
        .header h2 { font-size: 24px; margin: 0; font-weight: 600; }
        
        /* Information Grid (Simulated with Tables) */
        .info-grid { width: 100%; margin-bottom: 40px; }
        .info-grid td { vertical-align: top; width: 50%; padding-right: 20px; }
        .label { color: #6b7280; font-size: 12px; margin-bottom: 5px; display: block; }
        .value { font-weight: 500; margin-bottom: 15px; display: block; }
        .address { font-style: normal; color: #374151; line-height: 1.4; }

        /* Preline Table Style */
        .item-card { 
            border: 1px solid #e5e7eb; 
            border-radius: 8px; 
            padding: 15px; 
        }
        .table { width: 100%; border-collapse: collapse; }
        .table th { 
            text-align: left; 
            font-size: 11px; 
            text-transform: uppercase; 
            color: #6b7280; 
            padding: 10px 5px; 
            border-bottom: 1px solid #e5e7eb; 
        }
        .table td { padding: 15px 5px; border-bottom: 1px solid #f3f4f6; }
        .text-end { text-align: right; }

        /* Summary Section */
        .summary { width: 100%; margin-top: 30px; }
        .summary-table { width: 300px; margin-left: auto; }
        .summary-table td { padding: 5px; font-size: 14px; }
        .summary-label { color: #6b7280; text-align: right; padding-right: 20px; }
        .summary-value { font-weight: 600; text-align: right; }
    </style>
    <title>Product Report</title>
</head>
<body>

<div class="container">
    <div class="header">
        <div style="float: left;"><h2>Product Report</h2></div>
        <div style="float: right; color: #6b7280;">#INV-{{ $product->sku }}-{{ date('Y') }}</div>
        <div style="clear: both;"></div>
    </div>

    <table class="info-grid">
        <tr>
            <td>
                <span class="label">Billed to:</span>
                <span class="value" style="color: #2563eb;">{{ $product->supplier->email ?? 'contact@supplier.com' }}</span>

                <span class="label">Billing details:</span>
                <div class="value">
                    <strong>{{ $product->supplier->name ?? 'Global Supplier Co.' }}</strong><br>
                    <address class="address">
                        {{ $product->supplier->address ?? 'Tanger, Morocco' }}
                    </address>
                </div>
            </td>
            <td>
                <span class="label">Invoice number:</span>
                <span class="value">ADUQ2189H1-{{ $product->id }}</span>

                <span class="label">Currency:</span>
                <span class="value">MAD - Moroccan Dirham</span>

                <span class="label">Due date:</span>
                <span class="value">{{ now()->addDays(30)->format('d M Y') }}</span>
            </td>
        </tr>
    </table>

    <div class="item-card">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 40%;">Item</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th class="text-end">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div style="font-weight: 600;">{{ $product->name }}</div>
                        <div style="font-size: 11px; color: #6b7280;">SKU: {{ $product->sku }}</div>
                    </td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td class="text-end font-medium">{{ number_format($product->price * $product->quantity, 2) }} MAD</td>
                </tr>
                {{-- Ila bghiti t-zid d l-adjustments k-s-tour hna --}}
            </tbody>
        </table>
    </div>

    <div class="summary">
        <table class="summary-table">
            <tr>
                <td class="summary-label">Subtotal:</td>
                <td class="summary-value">{{ number_format($product->price * $product->quantity, 2) }} MAD</td>
            </tr>
            <tr>
                <td class="summary-label">Tax (0%):</td>
                <td class="summary-value">0.00 MAD</td>
            </tr>
            <tr>
                <td style="padding: 10px 0;"><hr style="border: none; border-top: 1px solid #e5e7eb;"></td>
                <td><hr style="border: none; border-top: 1px solid #e5e7eb;"></td>
            </tr>
            <tr>
                <td class="summary-label" style="font-size: 16px; color: #111827;">Total:</td>
                <td class="summary-value" style="font-size: 16px; color: #111827;">{{ number_format($product->price * $product->quantity, 2) }} MAD</td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>