<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PDF Document</title>
</head>
<body style="margin: 0; padding: 0; width: 100%; height: 100%; font-family: Arial, sans-serif; box-sizing: border-box;">
<div style="margin: 20px; padding: 20px; border: 1px solid #ddd; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);">
    <div style="width: 100%; margin: 0 auto; padding: 20px; box-sizing: border-box;">
        <div style="width: 100%; margin: 0 auto;">
            <div style="width: 80%; margin: 0 auto; padding: 20px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);">
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <address>
                            <strong>{{$sale['outlet']['name']}}</strong>
                            <br>
                            Contact Name : {{$sale['outlet']['contact_person_name']}}
                            <br>
                            Contact Phone : {{$sale['outlet']['phone']}}
                        </address>
                    </div>
                    <div style="text-align: right;">
                        <p>
                            <em>Date: {{date('d-M-Y H:i', strtotime($sale['created_at']))}}</em>
                        </p>
                        <p>
                            <em>Order #: {{$sale['id']}}</em>
                        </p>
                    </div>
                </div>
                <div>
                    <div style="text-align: center;">
                        <h1>Order Note</h1>
                    </div>
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Qty</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Price KSh</th>
                                <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Total KSh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sale['saleitems'] as $saleitem)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 8px; width: 75%;"><em>{{$saleitem['product']['name']}}</em></td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: center; width: 5%;">{{$saleitem['pieces']}}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: right; width: 10%;">{{number_format($saleitem['price'])}}</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: right; width: 10%;">{{number_format($saleitem['value'])}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td style="border: none;">&nbsp;</td>
                                <td style="border: none;">&nbsp;</td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: right;"><h4><strong>Total:</strong></h4></td>
                                <td style="border: 1px solid #ddd; padding: 8px; text-align: right; color: red;"><h4><strong>{{"".number_format($sale['value'])}}</strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>