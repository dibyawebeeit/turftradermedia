<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>New Enquiry</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
  <table cellpadding="0" cellspacing="0" width="100%" style="background-color: #f4f4f4; padding: 20px 0;">
    <tr>
      <td align="center">
        <table cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; font-family: Arial, sans-serif;">
          <tr>
            <td style="background-color: #007bff; padding: 20px; color: #ffffff; text-align: center; font-size: 24px;">
              New Enquiry Notification
            </td>
          </tr>
          <tr>
            <td style="padding: 30px;">
              <h2 style="margin-top: 0; font-size: 20px; color: #333;">Customer Details</h2>

              <p style="margin: 5px 0;"><strong>First Name:</strong> {{ $mailData['first_name'] }}</p>
              <p style="margin: 5px 0;"><strong>Last Name:</strong> {{ $mailData['last_name'] }}</p>
              <p style="margin: 5px 0;"><strong>Email:</strong> {{ $mailData['email'] }}</p>
              <p style="margin: 5px 0;"><strong>Phone:</strong> {{ $mailData['phone'] }}</p>
              <p style="margin: 5px 0;"><strong>Postal Code:</strong> {{ $mailData['postal_code'] }}</p>

              <h2 style="margin-top: 30px; font-size: 20px; color: #333;">Message</h2>
              <p style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #007bff; color: #333;">
                {{ $mailData['message'] }}
              </p>

              @if (!empty($mailData['marketing_opt_in']))
              <p style="margin-top: 30px; color: #555;">
                ✅ The user has opted to receive promotional emails.
              </p>
              @endif
            </td>
          </tr>
          <tr>
            <td style="background-color: #f0f0f0; text-align: center; padding: 15px; font-size: 12px; color: #777;">
              &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
