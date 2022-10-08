FROM python:3.9

WORKDIR /app
COPY ./public/requirements.txt /app/requirements.txt
RUN pip install --no-cache-dir -r /app/requirements.txt
COPY ./public /app/

CMD ["python", "main.py"]