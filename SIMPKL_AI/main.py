from fastapi import FastAPI, UploadFile, File, Form
from fastapi.middleware.cors import CORSMiddleware

from insightface.app import FaceAnalysis

import cv2
import numpy as np
import shutil
import os


app = FastAPI()


# ============================================================
# INSIGHTFACE
# ============================================================

face_app = FaceAnalysis()

face_app.prepare(
    ctx_id=-1,
    det_size=(320, 320)
)


# ============================================================
# CORS
# ============================================================

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


# ============================================================
# FOLDER AI
# ============================================================

AI_DIR = os.path.dirname(
    os.path.abspath(__file__)
)


# ============================================================
# FOLDER UTAMA SIMPKL
#
# main.py berada di:
#
# SIMPKL/
# └── SIMPKL-AI/
#     └── main.py
#
# Maka parent dari SIMPKL-AI adalah:
#
# SIMPKL/
# ============================================================

SIMPKL_DIR = os.path.dirname(
    AI_DIR
)


# ============================================================
# FOLDER STORAGE LARAVEL
# ============================================================

STORAGE_PUBLIC_DIR = os.path.join(
    SIMPKL_DIR,
    "storage",
    "app",
    "public"
)


# ============================================================
# FOLDER UPLOAD SELFIE SEMENTARA
# ============================================================

UPLOAD_DIR = os.path.join(
    AI_DIR,
    "uploads"
)


os.makedirs(
    UPLOAD_DIR,
    exist_ok=True
)


# ============================================================
# INFO PATH
# ============================================================

print(
    "=================================================="
)

print(
    "SIMPKL AI"
)

print(
    "=================================================="
)

print(
    "AI DIRECTORY :",
    AI_DIR
)

print(
    "SIMPKL DIR   :",
    SIMPKL_DIR
)

print(
    "STORAGE      :",
    STORAGE_PUBLIC_DIR
)

print(
    "UPLOAD DIR   :",
    UPLOAD_DIR
)

print(
    "=================================================="
)


# ============================================================
# ROOT
# ============================================================

@app.get("/")
def root():

    return {
        "status": "SIMPKL AI READY"
    }


# ============================================================
# DETECT FACE
# ============================================================

@app.post("/detect-face")
async def detect_face(

    image: UploadFile = File(...)

):

    contents = await image.read()


    nparr = np.frombuffer(

        contents,

        np.uint8

    )


    frame = cv2.imdecode(

        nparr,

        cv2.IMREAD_COLOR

    )


    if frame is None:

        return {

            "detected": False,

            "message": "Gambar tidak dapat dibaca"

        }


    faces = face_app.get(

        frame

    )


    if len(faces) == 0:

        return {

            "detected": False,

            "message": "Wajah tidak terdeteksi"

        }


    return {

        "detected": True,

        "message": "Wajah terdeteksi"

    }


# ============================================================
# GET EMBEDDING
# ============================================================

def get_embedding(path):

    print(
        "MEMBACA:",
        path
    )


    image = cv2.imread(

        path

    )


    if image is None:

        print(
            "GAGAL MEMBACA FOTO:",
            path
        )

        return None


    faces = face_app.get(

        image

    )


    if len(faces) == 0:

        print(
            "WAJAH TIDAK TERDETEKSI:",
            path
        )

        return None


    return faces[0].embedding


# ============================================================
# VERIFY FACE
# ============================================================

@app.post("/verify-face")
async def verify_face(

    selfie: UploadFile = File(...),

    foto_1: str = Form(None),

    foto_2: str = Form(None),

    foto_3: str = Form(None),

    foto_4: str = Form(None),

    foto_5: str = Form(None)

):

    # ========================================================
    # SIMPAN SELFIE SEMENTARA
    # ========================================================

    selfie_path = os.path.join(

        UPLOAD_DIR,

        selfie.filename

    )


    with open(

        selfie_path,

        "wb"

    ) as buffer:

        shutil.copyfileobj(

            selfie.file,

            buffer

        )


    # ========================================================
    # EMBEDDING SELFIE
    # ========================================================

    selfie_embedding = get_embedding(

        selfie_path

    )


    if selfie_embedding is None:

        return {

            "verified": False,

            "distance": 999,

            "message": "Wajah tidak terdeteksi"

        }


    # ========================================================
    # FOTO REFERENSI
    # ========================================================

    photos = [

        foto_1,

        foto_2,

        foto_3,

        foto_4,

        foto_5

    ]


    photos = [

        photo

        for photo in photos

        if photo

    ]


    # ========================================================
    # VARIABLE HASIL
    # ========================================================

    verified = False

    best_distance = 999

    best_photo = ""


    # ========================================================
    # LOOP FOTO REFERENSI
    # ========================================================

    for photo_path in photos:

        try:

            # ==================================================
            # BERSIHKAN PATH
            # ==================================================

            photo_path = photo_path.replace(
                "/",
                os.sep
            )


            # ==================================================
            # PATH LENGKAP FOTO
            #
            # Contoh database:
            #
            # registrasi_wajah_siswa/242/wajah_1.png
            #
            # Hasil:
            #
            # SIMPKL/storage/app/public/
            # registrasi_wajah_siswa/242/wajah_1.png
            # ==================================================

            full_path = os.path.join(

                STORAGE_PUBLIC_DIR,

                photo_path

            )


            print(
                "--------------------------------------------------"
            )

            print(
                "MEMBACA:",
                full_path
            )


            # ==================================================
            # CEK FILE
            # ==================================================

            if not os.path.exists(
                full_path
            ):

                print(
                    "FILE TIDAK DITEMUKAN:",
                    full_path
                )

                continue


            # ==================================================
            # EMBEDDING FOTO REFERENSI
            # ==================================================

            reference_embedding = get_embedding(

                full_path

            )


            if reference_embedding is None:

                continue


            # ==================================================
            # HITUNG DISTANCE
            # ==================================================

            distance = np.linalg.norm(

                selfie_embedding
                -
                reference_embedding

            )


            print(
                "FILE:",
                full_path
            )


            print(
                "DISTANCE:",
                distance
            )


            # ==================================================
            # SIMPAN DISTANCE TERBAIK
            # ==================================================

            if distance < best_distance:

                best_distance = distance

                best_photo = photo_path


            # ==================================================
            # BATAS VERIFIKASI
            # ==================================================

            if distance < 18:

                verified = True

                break


        except Exception as e:

            print(
                "ERROR:",
                e
            )


    # ========================================================
    # HASIL
    # ========================================================

    return {

        "verified": verified,

        "distance": float(
            best_distance
        ),

        "matched_file": best_photo,

        "message":

            "Wajah cocok"

            if verified

            else

            "Wajah tidak sesuai"

    }