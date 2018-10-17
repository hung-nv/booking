<?php

namespace App\Http\Controllers\Backend;

use App\Models\AttributeValue;
use App\Http\Controllers\Controller;
use App\Services\AttributeServices;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
{
    private $attributeServices;

    public function __construct(AttributeServices $attributeServices)
    {
        parent::__construct();
        $this->attributeServices = $attributeServices;
    }

    /**
     * Get all attribute to show.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $attributes = $this->attributeServices->getAttributeValues();

        return view('backend.attributeValue.index', [
            'data' => $attributes
        ]);
    }

    /**
     * Delete attribute value.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id) {
        $attribute = AttributeValue::findOrFail($id);

        if ($attribute->delete()) {
            Session::flash('success', 'Your attribute has been delete!');
        } else {
            Session::flash('error', 'Fail to delete attribute');
        }

        return redirect()->route('attributeValue.index');
    }
}
