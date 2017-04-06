<?php

namespace Myrtle\Core\Vendors\Http\Controllers\Administrator;

use Myrtle\Notes\Models\Note;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Myrtle\Core\Vendors\Models\Vendor;

class VendorNoteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create(Vendor $vendor, Note $note)
	{
		return view('admin::vendors.notes.create', ['note' => $note, 'vendor' => $vendor]);
	}

	public function store(Requests\SaveVendorNoteRequest $request, Vendor $vendor, Note $note)
	{
		$note->fill($request->toArray());
		$note->save();

		$vendor->notes()->attach($note->id);

		return redirect(route('admin.vendors.show', $vendor->id));
	}
}
