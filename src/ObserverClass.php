<?php
interface Observe{
    public function update(string $event):void;
}
class EmailNotifier implements Observe{
    public function update(string $event): void
    {
        echo "Email sent : $event";
    }
}
class BookingSystem {
    private array $observes = [];
    public function addObserver(Observe $observer):void{
        $this->observes[] = $observer;
    }
}
public function bookTicket():void{
    $this->notify("ticket booked");
}
