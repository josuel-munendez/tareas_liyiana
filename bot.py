import pyautogui,keyboard
import time

time.sleep(1)

codigo = """git add .
git commit -m "Primer commit - subiendo proyecto desde mi PC"
git branch -M main
git push -u origin main
"""

# pyautogui.write(codigo, interval=0.01)  # interval = velocidad de escritura
keyboard.write(codigo, delay=0.01)  # respeta +, ñ, tildes, etc.