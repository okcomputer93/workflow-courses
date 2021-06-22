<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCourses extends Component
{
    use WithPagination;

    public Collection $levels;
    public Collection $categories;
    public $search;
    public $category;
    public $level;
    public $resultsPerPage = 10;
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'level' => ['except' => '']
    ];

    public function mount()
    {
        $this->levels = Level::all();
        $this->categories = Category::all();
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->dispatchBrowserEvent('search-updated');

        return view('livewire.show-courses', [
            'courses' => $this->querySearch()
        ]);
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->level = '';
        $this->category = '';
        $this->resetPage();
    }

    protected function querySearch()
    {
        $queryString = '%' . str_replace(' ', '%%', $this->search) . '%';

        return Course::where(function (Builder $query) use($queryString) {
            $query->where('title', 'like', $queryString)
                ->orWhereHas('owner', function (Builder $query) use ($queryString) {
                    $query->where('name', 'like', $queryString);
                });
        })->when($this->category, function (Builder $query) {
            $query->whereHas('category', function (Builder $query) {
                $query->whereName($this->category);
            });
        })->when($this->level, function (Builder $query) {
            $query->whereHas('level', function (Builder $query) {
                $query->whereName($this->level);
            });
        })->with('owner')
            ->latest()
            ->paginate($this->resultsPerPage);
    }
}
