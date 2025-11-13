<div class="w-full flex flex-col gap-4">
    <div class="w-full flex gap-6">
        <x-partials.settings.card-template 
            title="Rewards System Settings" 
            details="Setup points levels & rewards." 
            link="settings/rewards"
        />

        <x-partials.settings.card-template 
            title="Backup & Restore" 
            details="Create backup restore-data." 
            link="settings/backup"
        />
    </div>

    <div class="w-full flex gap-6">
        <x-partials.settings.card-template 
            title="System Maintenance" 
            details="Toggle system maintenance mode & updates." 
            link="settings/system-maintenance"
        />

        <x-partials.settings.card-template 
            title="Transaction Limits" 
            details="Detine limits on user transaction." 
            link="settings/transaction"
        />
    </div>
</div>