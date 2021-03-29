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

    private $patient;
    private $doctor;
    private $appointment;
    private $isPatient;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $appointment, $patient, $doctor, bool $isPatient)
    {
        $this->appointment = $appointment;
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->isPatient = $isPatient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $subject = ($this->patient['name'] .", se ha creado una nueva cita médica con el médico " .$this->doctor['name'] );
        $calendarText = Calendar::create('Citas medicas HV')
        ->event(Event::create($subject)
            ->startsAt(new DateTime($this->appointment))
            ->endsAt(new DateTime(Carbon::parse($this->appointment)->addHour(1)->format('d-m-Y H:i:s')))
            ->organizer(config('mail.username'),config('app.name'))
            ->attendee($this->patient['email'], $this->patient['name'])
            ->attendee($this->doctor['email'], $this->doctor['name'])
        )
        ->get();

        if ($this->isPatient){
            return $this->subject($this->patient['name'] .", se ha creado una nueva cita médica con el médico " .$this->doctor['name'] )
            ->markdown('mail.newAppointmentPatient', ['patientName' => $this->patient['name'], 
            'doctorName' => $this->doctor['name'], 'appointment' => $this->appointment, 'isPatient' => $this->isPatient])
            ->attachData(
                $calendarText, 
                'calendar.ics',
                ['mime'=> 'text/calendar']
             );
        }
        else{
            return $this->subject($this->doctor['name'] .", se ha creado una nueva cita médica con el paciente " .$this->patient['name'] )
            ->markdown('mail.newAppointmentDoctor', ['patientName' => $this->patient['name'], 
            'doctorName' => $this->doctor['name'], 'appointment' => $this->appointment, 'isPatient' => $this->isPatient])
            ->attachData(
                $calendarText, 
                'calendar.ics',
                ['mime'=> 'text/calendar']
             );
        }

    }
}
