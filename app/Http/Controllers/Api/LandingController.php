<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Page;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\LandingResource;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\BaseApiController;

class LandingController extends BaseApiController
{
    public function index ()
    {
        try {
            if (Page::query()->count() === 0) {
                throw new Exception('Записей страницы не найдено !' . __METHOD__);
                return $this->sendError('Записей страницы не найдено !');
            }

            return new LandingResource(Page::with(['navigations' => fn ($q) => $q->with('cards'), 'seo'])->first());
        }
        catch (\Exception $e) {
            Log::info('Page error: ' . $e->getMessage());
            return $this->sendError( 'Что то пошло не так !' . $e->getMessage(), $e->getCode());
        }
    }

    public function contactForm(ContactFormRequest $request)
    {
        try {
            $form = ContactForm::create([
                'email' => $request->email,
            ]);
            if ($form->save()) {
                return $this->sendResponse('Email, успешно добавлен !');
            }
            else {
                return $this->sendError('Что то пошло не так');
            }
        }
        catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}
