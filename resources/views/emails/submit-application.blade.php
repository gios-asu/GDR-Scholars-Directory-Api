@component('mail::message')
# Fellowship Application Submitted

## {{ $application['opportunityTitle'] }}

@component('mail::panel')
Applicant Name: {{ $application['applicantName'] }}  
Applicant Email: {{ $application['applicantEmail'] }}  
@if (!empty($application['filePath']))
Applicant CV: {{ $application['filePath'] }}  
@endif

Application Statement: {{ $application['applicantStatement'] }}  
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
