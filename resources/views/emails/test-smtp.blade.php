<x-emails.layout :heading="'SMTP Test Email'">
    <p style="margin:0 0 16px;">This is a test email sent from your website's admin settings page.</p>
    <p style="margin:0 0 16px;">If you're reading this, your SMTP configuration is working correctly — outgoing email (contact form notifications, etc.) will be delivered through this connection.</p>
    <p style="margin:0;color:#8a7a63;font-size:13px;">Sent: {{ now()->format('d M Y, h:i A') }}</p>
</x-emails.layout>
