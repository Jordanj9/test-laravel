@component('mail::message')
    #Notificación

    El usuario {{$user->name}} acaba de crear un nuevo registro para la tarea
    {{$log->task->description}} con fecha maxima de ejecución {{$log->task->maximum_execution_date}}.

    @component('mail::button', ['url' => ''])
        {{$log->comment}}
    @endcomponent

    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
