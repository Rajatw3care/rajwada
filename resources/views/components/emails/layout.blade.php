<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $subject ?? (config('app.name') ?: 'Rajwada Events') }}</title>
</head>
<body style="margin:0;padding:0;background:#f4ede4;font-family:Georgia,'Times New Roman',serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f4ede4;padding:32px 16px;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" style="max-width:560px;background:#ffffff;border-radius:10px;overflow:hidden;border:1px solid #e6d9c3;">
          <tr>
            <td style="background:#7a0f1c;padding:24px 32px;">
              <span style="color:#e8cf94;font-size:12px;letter-spacing:.14em;text-transform:uppercase;">{{ config('app.name') ?: 'Rajwada Events' }}</span>
              <div style="color:#ffffff;font-size:20px;font-weight:bold;margin-top:4px;">{{ $heading ?? '' }}</div>
            </td>
          </tr>
          <tr>
            <td style="padding:28px 32px;color:#2b2b2b;font-size:15px;line-height:1.6;">
              {{ $slot }}
            </td>
          </tr>
          <tr>
            <td style="padding:16px 32px;background:#f8f2e8;border-top:1px solid #e6d9c3;color:#8a7a63;font-size:12px;">
              {{ config('app.name') ?: 'Rajwada Events' }} — sent automatically, please do not reply directly to this address unless a reply-to is shown above.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
