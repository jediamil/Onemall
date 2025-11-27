<div class="w-full flex flex-col gap-4">
    <div class="w-full flex flex-col lg:flex-row items-center gap-6">
        <x-partials.settings.card-template 
            title="Rewards System Settings" 
            details="Setup points levels & rewards." 
            link="/settings/rewards/value"
        />


        <x-partials.settings.card-template 
            title="Transaction Limits" 
            details="Detine limits on user transaction." 
            link="/settings/transaction/value"
        />
    </div>
</div>