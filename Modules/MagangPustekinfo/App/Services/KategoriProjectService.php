<?php

namespace Modules\MagangPustekinfo\App\Services;

use Modules\MagangPustekinfo\App\Models\KategoriProjectModel;
use Illuminate\Http\Request;

class KategoriProjectService
{
    protected $kategoriProjectModel;

    public function __construct(KategoriProjectModel $kategoriProjectModel)
    {
        $this->kategoriProjectModel = $kategoriProjectModel;
    }

    public function getAllActiveKategoriProject(Request $request = null)
    {
        $query = $this->kategoriProjectModel->query();

        if ($request && $request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        return $query->ordered()->paginate($request ? $request->get('per_page', 10) : 10);
    }

    public function createKategoriProject(array $data)
    {
        return $this->kategoriProjectModel->create($data);
    }

    public function getKategoriProjectById($id)
    {
        return $this->kategoriProjectModel->findOrFail($id);
    }

    public function updateKategoriProject($id, array $data)
    {
        $kategori = $this->kategoriProjectModel->findOrFail($id);
        $kategori->update($data);
        return $kategori;
    }

    public function deleteKategoriProject($id)
    {
        $kategori = $this->kategoriProjectModel->findOrFail($id);
        $kategori->delete();
        return $kategori;
    }

    public function toggleStatus($id)
    {
        $kategori = $this->kategoriProjectModel->findOrFail($id);
        $kategori->update([
            'is_active' => !$kategori->is_active
        ]);
        return $kategori;
    }

    public function validateKategoriProjectData(Request $request, $id = null)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ];

        return $request->validate($rules);
    }

    public function checkDuplicate($name, $excludeId = null)
    {
        $query = $this->kategoriProjectModel->where('name', $name);
        
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->first();
    }
}
