<?php

namespace App\Http\Livewire;

use App\Models\Record;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Subrecord;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Subrecord';

    protected $rules = [
        'subrecordDatetime' => ['nullable', 'date'],
        'subrecordDate' => ['nullable', 'date'],
        'subrecord.time' => ['nullable', 'date_format:H:i'],
        'subrecord.n_p_w_p' => ['nullable'],
        'subrecord.markdown_text' => ['nullable', 'string'],
        'subrecord.w_y_s_i_w_y_g' => ['nullable', 'string'],
        'subrecordFile' => ['file', 'max:1024', 'nullable'],
        'subrecordImage' => ['image', 'max:1024', 'nullable'],
        'subrecord.i_p_address' => ['nullable', 'max:255'],
        'subrecord.j_s_o_n_list' => ['nullable'],
        'subrecord.j_s_o_n_list' => ['nullable'],
        'subrecord.j_s_o_n_list' => ['nullable'],
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

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSubrecord(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.record_subrecords.new_title');
        $this->resetSubrecordData();

        $this->showModal();
    }

    public function editSubrecord(Subrecord $subrecord): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.record_subrecords.edit_title');
        $this->subrecord = $subrecord;

        $this->subrecordDatetime = optional($this->subrecord->datetime)->format(
            'Y-m-d'
        );
        $this->subrecordDate = optional($this->subrecord->date)->format(
            'Y-m-d'
        );

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
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

        $this->subrecord->j_s_o_n_list = json_decode(
            $this->subrecord->j_s_o_n_list,
            true
        );

        $this->subrecord->j_s_o_n_list = json_decode(
            $this->subrecord->j_s_o_n_list,
            true
        );

        $this->subrecord->j_s_o_n_list = json_decode(
            $this->subrecord->j_s_o_n_list,
            true
        );

        $this->subrecord->datetime = \Carbon\Carbon::make(
            $this->subrecordDatetime
        );
        $this->subrecord->date = \Carbon\Carbon::make($this->subrecordDate);

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
            'subrecords' => $this->record->subrecords()->paginate(20),
        ]);
    }
}
