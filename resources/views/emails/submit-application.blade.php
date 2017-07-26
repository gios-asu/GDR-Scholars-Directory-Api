@component('mail::message')
# Fellowship Application Submitted

## {{ $application['opportunityTitle'] }}

@component('mail::panel')
Applicant Name: {{ $application['applicantName'] }}<br />
Applicant Email: {{ $application['applicantEmail'] }}<br />
@if (!empty($application['fileUpload']))
Applicant CV: <a href="{{ $application['fileUpload'] }}">Download CV</a><br />
@endif

Application Statement: {{ $application['applicantStatement'] }}<br />
@endcomponent

Please review this applicant for suitability in your program.


Thank you,<br>
{{ config('app.name') }}
@endcomponent
