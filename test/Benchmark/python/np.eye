# coding: utf8
import numpy as np

for i in range(1, 11):
  for j in range(1, 11):
    for k in range(-5, 5):
      m = np.eye(i, j, k)
