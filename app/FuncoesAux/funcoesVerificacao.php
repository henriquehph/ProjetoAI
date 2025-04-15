<?php

namespace App\FuncoesAux;

use Illuminate\Http\UploadedFile;

class funcoesVerificacao
{
      /**
     * Trata da verificação de uma imagem submetida por um user
     
     * @param UploadedFile $photo
     * @return string|null
     */
    public static function uploadProfilePhoto(?UploadedFile $photo): ?string
    {
        if ($photo && $photo->isValid()) { //verifica se a foto existe e é válida
            // define um caminho onde a foto é guardada se não for null
            $path = $photo->store('profile_photos', 'public'); 
            return $path;
        }
        // Se a foto não for válida, retorna null
        return null;
    }
}