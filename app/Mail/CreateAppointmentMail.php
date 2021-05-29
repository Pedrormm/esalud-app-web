<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use DateTime;

use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;


class CreateAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    private $appointmentId;
    private $dateTimeAppointment;
    private $patient;
    private $doctor;
    private $role;
    private $appointmentUserCreatorRole;
    private $isPatient;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointmentId, $dateTimeAppointment, $patient, $doctor, $role, int $appointmentUserCreatorRole, bool $isPatient)
    {
        $this->appointmentId = $appointmentId;
        $this->dateTimeAppointment = $dateTimeAppointment;
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->role = $role;
        $this->appointmentUserCreatorRole = $appointmentUserCreatorRole;
        $this->isPatient = $isPatient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = ($this->patient['name'] .\Lang::get('messages.a new appointment has been created with the doctor') .$this->doctor['name'] );
        $calendarText = Calendar::create('Citas medicas HV')
        ->event(Event::create($subject)
            ->startsAt(new DateTime($this->dateTimeAppointment))
            ->endsAt(new DateTime(Carbon::parse($this->dateTimeAppointment)->addMinutes(30)->format('d-m-Y H:i:s')))
            ->organizer(config('mail.username'),config('app.name'))
            ->attendee($this->patient['email'], $this->patient['name'])
            ->attendee($this->doctor['email'], $this->doctor['name'])
        )
        ->get();

        if ($this->isPatient){
            return $this->subject($this->patient['name'] .\Lang::get('messages.a new appointment has been created with the doctor') .$this->doctor['name'] )
            ->markdown('mail.newAppointmentPatient', ['patientName' => $this->patient['name'], 
            'doctorName' => $this->doctor['name'], 'dateTimeAppointment' => $this->dateTimeAppointment, 'isPatient' => $this->isPatient,
             'role' => $this->role, 'appointmentUserCreatorRole' => $this->appointmentUserCreatorRole, 'appointmentId' => $this->appointmentId])
            ->attachData(
                $calendarText, 
                'calendar.ics',
                ['mime'=> 'text/calendar']
             );
        }
        else{
            return $this->subject($this->doctor['name'] .\Lang::get('messages.a new appointment has been created with the patient') .$this->patient['name'] )
            ->markdown('mail.newAppointmentDoctor', ['patientName' => $this->patient['name'], 
            'doctorName' => $this->doctor['name'], 'dateTimeAppointment' => $this->dateTimeAppointment, 'isPatient' => $this->isPatient,
             'role' => $this->role, 'appointmentUserCreatorRole' => $this->appointmentUserCreatorRole,'appointmentId' => $this->appointmentId])
            ->attachData(
                $calendarText, 
                'calendar.ics',
                ['mime'=> 'text/calendar']
             );
        }

    }
}
