<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Welcome Email</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4;">

  <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #ffffff; margin: 20px auto; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <tr>
      <td style="background-color: #007BFF; padding: 20px; text-align: center; color: #ffffff;">
        <h1 style="margin: 0; font-size: 24px;">Welcome to Our Website!</h1>
      </td>
    </tr>

    <tr>
      <td style="padding: 30px; color: #333333;">
        <p style="font-size: 16px; line-height: 1.5;">Hi {{ $name }},</p>

        <p style="font-size: 16px; line-height: 1.5;">
          Thank you for registering with us! We're thrilled to have you join our community.
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
          You can now log in and explore everything we have to offer.
        </p>

        <p style="text-align: center; margin: 30px 0;">
          <a href="{{ $loginUrl }}" style="background-color: #007BFF; color: #ffffff; padding: 12px 25px; border-radius: 4px; text-decoration: none; font-size: 16px;">Login to Your Account</a>
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
          If you have any questions, feel free to reply to this email.
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
          Cheers,<br>
          The {{ config('app.name') }} Team
        </p>
      </td>
    </tr>

    <tr>
      <td style="background-color: #f0f0f0; text-align: center; padding: 20px; font-size: 12px; color: #777777;">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
      </td>
    </tr>
  </table>

</body>
</html>
