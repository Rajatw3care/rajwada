<x-emails.layout :heading="'New Website Enquiry'">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:16px;">
        <tr>
            <td style="padding:6px 0;color:#8a7a63;font-size:12px;text-transform:uppercase;letter-spacing:.06em;width:110px;">Name</td>
            <td style="padding:6px 0;font-weight:bold;">{{ $contactMessage->name }}</td>
        </tr>
        <tr>
            <td style="padding:6px 0;color:#8a7a63;font-size:12px;text-transform:uppercase;letter-spacing:.06em;">Phone</td>
            <td style="padding:6px 0;"><a href="tel:{{ $contactMessage->phone }}" style="color:#7a0f1c;">{{ $contactMessage->phone }}</a></td>
        </tr>
        <tr>
            <td style="padding:6px 0;color:#8a7a63;font-size:12px;text-transform:uppercase;letter-spacing:.06em;">Email</td>
            <td style="padding:6px 0;"><a href="mailto:{{ $contactMessage->email }}" style="color:#7a0f1c;">{{ $contactMessage->email }}</a></td>
        </tr>
        <tr>
            <td style="padding:6px 0;color:#8a7a63;font-size:12px;text-transform:uppercase;letter-spacing:.06em;">Received</td>
            <td style="padding:6px 0;">{{ $contactMessage->created_at->format('d M Y, h:i A') }}</td>
        </tr>
    </table>

    <div style="padding:16px;background:#f8f2e8;border-radius:8px;border:1px solid #e6d9c3;white-space:pre-wrap;">{{ $contactMessage->message }}</div>

    <p style="margin:20px 0 0;font-size:13px;color:#8a7a63;">Reply directly to this email to respond to {{ $contactMessage->name }}, or view it in the admin panel under Contact Messages.</p>
</x-emails.layout>
