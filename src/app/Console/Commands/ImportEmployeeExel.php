<?php

namespace App\Console\Commands;

use App\Jobs\ImportExel;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Exception\CommandNotFoundException;

class ImportEmployeeExel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // php artisan import:employee employee.xlsx
    protected $signature = 'import:employee {file : Full filename located at storage/import}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var array|string[]
     */
    protected array $availableFormats = ['xls', 'xlsx'];

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->checkFileFormat();

        $filePath = storage_path(
            sprintf('import/%s', $this->argument('file'))
        );

        ImportExel::dispatch($filePath);
    }

    /**
     * @return void
     */
    protected function checkFileFormat(): void
    {
        $fileExtension = explode('.', $this->argument('file'));
        $fileExtension = Arr::last($fileExtension);

        if ( ! in_array($fileExtension, $this->availableFormats)) {
            throw new CommandNotFoundException(
                sprintf('File format %s is not available.', $fileExtension)
            );
        }
    }
}
