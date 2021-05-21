<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ShowCourses extends Component
{
    public Collection $levels;
    public Collection $categories;
    public $search;
    public $category;
    public $level;

    public function mount()
    {
        $this->levels = Level::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.show-courses', [
            'courses' => Course::where(function (Builder $query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhereHas('owner', function (Builder $query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })->when($this->category, function (Builder $query) {
                $query->whereHas('category', function (Builder $query) {
                    $query->whereId($this->category);
                });
            })->when($this->level, function (Builder $query) {
                $query->whereHas('level', function (Builder $query) {
                    $query->whereId($this->level);
                });
            })->get()
        ]);
    }
}
