@component('mail::message')
# Fellowship Application Submitted

## {{ $application['opportunityTitle'] }}

@component('mail::panel')
Applicant Name: {{ $application['applicantName'] }}  
Applicant Email: {{ $application['applicantEmail'] }}  
Applicant CV: https://s3-us-west-2.amazonaws.com/gios-server-uploads/{{ $application['filePath']  }}  

Application Statement: {{ $application['applicantStatement'] }}  
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
