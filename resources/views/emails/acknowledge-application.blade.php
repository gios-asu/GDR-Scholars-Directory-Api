@component('mail::message')
# Fellowship Application Submitted

## Your fellowship application has been successfully submitted:

## {{ $application['opportunityTitle'] }}

@component('mail::panel')
Applicant Name: {{ $application['applicantName'] }}<br />
Applicant Email: {{ $application['applicantEmail'] }}<br />
@if (!empty($application['fileUpload']))
Applicant CV: <a href="{{ $application['fileUpload'] }}">Download CV</a><br />
@endif

Applicant's Cover Letter: {{ $application['applicantStatement'] }}<br />
@endcomponent

You will be contacted by the program host once your application has been reviewed and further action is to be taken.

Your patience is appreciated.


Thank you,<br>
{{ config('app.name') }}
@endcomponent
