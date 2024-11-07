<div>
    <x-filament-actions::group :actions="[
        $this->downloadAction,
        $this->giveFeedbackAction,
        $this->reserveAction,
    ]" />
 
    <x-filament-actions::modals />
</div>
