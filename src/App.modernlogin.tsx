import React, { useState } from 'react';
import { ThemeProvider } from '@mui/material/styles';
import CssBaseline from '@mui/material/CssBaseline';
import LoginPage from './components/LoginPage';
import theme from './theme';

const App: React.FC = () => {
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);

  const handleLogin = (email: string, password: string, remember: boolean) => {
    setLoading(true);
    setError('');
    
    // Simulate API call
    setTimeout(() => {
      if (email === 'demo@example.com' && password === 'password') {
        alert('Login successful!');
        setError('');
      } else {
        setError('Invalid email or password. Try demo@example.com / password');
      }
      setLoading(false);
    }, 1500);
  };

  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <LoginPage 
        onSubmit={handleLogin}
        error={error}
        loading={loading}
      />
    </ThemeProvider>
  );
};

export default App;