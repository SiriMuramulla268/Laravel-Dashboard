<!DOCTYPE html>
<html>
<body>
    <h1>Hotel {{ $details['hotel'] }}</h1>
    <p>Dear {{ $details['user'] }},</p>
    <p>Greetings!</p><br>
    <p>Thank you for choosing Hotel {{ $details['hotel'] }}. </p>
    <p>Your booking no. {{ $details['booking_no'] }} has been booked successfully.
      We look forward to hosting your stay.
    </p>
    <br>
    <p>Booking Details</p>
    <table>
      <tr><td>Transaction No - {{ $details['transaction_no'] }}</td></tr>
      <tr><td>CheckIn - {{ $details['check_in'] }}</td></tr>
      <tr><td>CheckOut - {{ $details['check_out'] }}</td></tr>
      <tr><td>Rooms - {{ $details['rooms'] }}</td></tr>
      <tr><td>Adult - {{ $details['adult'] }}</td></tr>
    </table>
    
    <br>
    <p>Thank you,</p>
    <p>Hotel {{ $details['hotel']</p>
</body>
</html>

