<?php

namespace App\Http\Livewire;

use App\Models\Record;
use App\Models\Subrecord;
use Carbon\Carbon;
use fredyns\stringcleaner\StringCleaner;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Snippet\Helpers\NPWP;

class RecordSubrecordsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Record $record;
    public Subrecord $subrecord;
    public $subrecordFile;
    public $subrecordImage;
    public $uploadIteration = 0;
    public $subrecordDatetime;
    public $subrecordDate;
    public $subrecordTime;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModalView = false;
    public $showingModalForm = false;

    public $modalTitle = 'New Subrecord';

    protected $rules = [
        'subrecordDatetime' => ['nullable', 'date'],
        'subrecordDate' => ['nullable', 'date'],
        'subrecordTime' => ['nullable', 'date_format:H:i'],
        'subrecord.n_p_w_p' => ['nullable'],
        'subrecord.markdown_text' => ['nullable', 'string'],
        'subrecord.w_y_s_i_w_y_g' => ['nullable', 'string'],
        'subrecordFile' => ['file', 'max:1024', 'nullable'],
        'subrecordImage' => ['image', 'max:1024', 'nullable'],
        'subrecord.i_p_address' => ['nullable', 'max:255'],
        'subrecord.latitude' => ['nullable', 'numeric'],
        'subrecord.longitude' => ['nullable', 'numeric'],
    ];

    public function mount(Record $record): void
    {
        $this->record = $record;
        $this->resetSubrecordData();
    }

    public function resetSubrecordData(): void
    {
        $this->subrecord = new Subrecord();

        $this->subrecordFile = null;
        $this->subrecordImage = null;
        $this->subrecordDatetime = null;
        $this->subrecordDate = null;
        $this->subrecordTime = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSubrecord(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.record_subrecords.new_title');
        $this->resetSubrecordData();

        $this->showModalForm();
        $this->emit('reset-trix');
    }

    public function viewSubrecord(Subrecord $subrecord): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.record_subrecords.show_title');
        $this->subrecord = $subrecord;

        $this->subrecordDatetime = optional($this->subrecord->datetime)->format(
            'Y-m-d H:i:s'
        );

        $this->subrecordDate = optional($this->subrecord->date)->format(
            'Y-m-d'
        );

        $this->subrecordTime = optional($this->subrecord->time)->format('H:i');

        $this->dispatchBrowserEvent('refresh');

        $this->showModalView();
    }

    public function editSubrecord(Subrecord $subrecord): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.record_subrecords.edit_title');
        $this->subrecord = $subrecord;

        $this->subrecordDatetime = optional($this->subrecord->datetime)->format(
            'Y-m-d H:i:s'
        );

        $this->subrecordDate = optional($this->subrecord->date)->format(
            'Y-m-d'
        );

        $this->subrecordTime = optional($this->subrecord->time)->format('H:i');

        $this->dispatchBrowserEvent('refresh');

        $this->showModalForm();
        $this->emit('reset-trix');
    }

    public function showModalView(): void
    {
        $this->resetErrorBag();
        $this->showingModalView = true;
        $this->showingModalForm = false;
    }

    public function showModalForm(): void
    {
        $this->resetErrorBag();
        $this->showingModalView = false;
        $this->showingModalForm = true;
    }

    public function hideModal(): void
    {
        $this->showingModalView = false;
        $this->showingModalForm = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->subrecord->record_id) {
            $this->authorize('create', Subrecord::class);

            $this->subrecord->record_id = $this->record->id;
        } else {
            $this->authorize('update', $this->subrecord);
        }

        if ($this->subrecordFile) {
            $this->subrecord->file = $this->subrecordFile->store('public');
        }

        if ($this->subrecordImage) {
            $this->subrecord->image = $this->subrecordImage->store('public');
        }

        $this->subrecord->datetime = Carbon::make(
            $this->subrecordDatetime
        );
        $this->subrecord->date = Carbon::make($this->subrecordDate);

        $this->subrecord->time = $this->subrecordTime ? $this->subrecordTime . ':00' : null;

        $this->subrecord->markdown_text = StringCleaner::forRTF($this->subrecord->markdown_text);
        $this->subrecord->w_y_s_i_w_y_g = StringCleaner::forRTF($this->subrecord->w_y_s_i_w_y_g);
        $this->subrecord->n_p_w_p = NPWP::native($this->subrecord->n_p_w_p);

        $this->subrecord->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Subrecord::class);

        collect($this->selected)->each(function (string $id) {
            $subrecord = Subrecord::findOrFail($id);

            if ($subrecord->file) {
                Storage::delete($subrecord->file);
            }

            if ($subrecord->image) {
                Storage::delete($subrecord->image);
            }

            $subrecord->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSubrecordData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->record->subrecords as $subrecord) {
            array_push($this->selected, $subrecord->id);
        }
    }

    public function render(): View
    {
        return view('livewire.record-subrecords-detail', [
            'subrecords' => $this->record->subrecords()->paginate(100),
        ]);
    }
}
