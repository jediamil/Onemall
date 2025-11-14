<x-layouts.app title="System maintenance">
    <div class="flex justify-center items-start md:items-center w-full">
        <div class="w-full bg-black/20 p-4 m-4 md:m-0 md:p-10 md:mr-10 rounded-3xl min-h-[84vh]">
            <x-partials.admin-header title="Backup & Restore" />
                <div class="w-full flex flex-col gap-4">
                    <div class="w-full flex gap-6">
                        <x-partials.settings.card-template 
                            title="Rewards System Settings" 
                            details="Setup points levels & rewards." 
                            link="settings/backup"
                        />
                    </div>
                </div>
            </div>
        </x-layouts.app>